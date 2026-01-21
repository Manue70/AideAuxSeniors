<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\AssistantMessage;
use Illuminate\Support\Facades\Auth;

class AssistantController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userId = Auth::id();
        $message = $request->input('message');

        // 👵 Contexte utilisateur
        $user = Auth::user();
        $prenom = $user->prenom ?? 'Utilisateur';
        $habitudes = $user->habitudes ?? 'Aucune information sur les habitudes.';

        // 1️⃣ Détecter phrases sensibles
        $sensitiveKeywords = [
            'je me sens mal',
            'je suis triste',
            'je suis seul',
            'j’ai peur',
            'je n’y arrive plus',
            'je suis fatigué',
            'je vais mal',
            'je suis déprimé'
        ];
        $isSensitive = collect($sensitiveKeywords)
            ->contains(fn($k) => str_contains(strtolower($message), $k));

        // 2️⃣ Enregistrer le message utilisateur
        try {
            AssistantMessage::create([
                'user_id' => $userId,
                'role' => 'user',
                'content' => $message,
                'is_sensitive' => $isSensitive,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Erreur sauvegarde message utilisateur : ' . $e->getMessage());
        }

        // 3️⃣ Récupérer l'historique des 10 derniers messages
        $history = AssistantMessage::where('user_id', $userId)
            ->orderBy('created_at')
            ->take(10)
            ->get()
            ->map(fn($m) => [
                'role' => $m->role,
                'content' => $m->content,
            ])
            ->toArray();

        // 4️⃣ Préparer le prompt système
        $systemPrompt = "Tu es un assistant bienveillant pour un senior. 
L'utilisateur s'appelle $prenom. Habitudes : $habitudes. 
Réponds calmement et clairement. 
Si le message semble sensible, adapte le ton pour la fatigue cognitive.";

        // 5️⃣ Préparer la liste de messages à envoyer à OpenAI
        $messages = array_merge(
            [
                ['role' => 'system', 'content' => $systemPrompt],
            ],
            $history,
            [
                ['role' => 'user', 'content' => $message],
            ]
        );

        // 6️⃣ Appel OpenAI
        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => $messages,
            ]);

            $reply = $response->choices[0]->message->content ?? 'Pas de réponse';

        } catch (\Throwable $e) {
            $reply = "Désolé, je n'arrive pas à répondre pour le moment.";
            \Log::error('Erreur OpenAI : ' . $e->getMessage());
        }

        // 7️⃣ Enregistrer la réponse assistant
        try {
            AssistantMessage::create([
                'user_id' => $userId,
                'role' => 'assistant',
                'content' => $reply,
                'is_sensitive' => false,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Erreur sauvegarde message assistant : ' . $e->getMessage());
        }

        // 8️⃣ Limiter mémoire (optionnel, pour éviter trop de données)
        try {
            $messagesToDelete = AssistantMessage::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->skip(30)
                ->take(100)
                ->get();
            foreach ($messagesToDelete as $m) {
                $m->delete();
            }
        } catch (\Throwable $e) {
            \Log::error('Erreur limitation mémoire : ' . $e->getMessage());
        }

        // 9️⃣ Réponse JSON pour le JS
        return response()->json(['reply' => $reply]);
    }

    /**
     * Historique pour chargement au départ
     */
    public function history()
    {
        $userId = Auth::id();
        $messages = AssistantMessage::where('user_id', $userId)
            ->orderBy('created_at')
            ->take(10)
            ->get()
            ->map(fn($m) => [
                'role' => $m->role,
                'content' => $m->content,
            ]);

        return response()->json($messages);
    }
}
