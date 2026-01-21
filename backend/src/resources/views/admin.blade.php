@extends('layouts.app')

@section('title', 'Admin – SeniorAide')

@section('content')
<div class="admin-page">

    <h1>Tableau de bord Admin</h1>
    <p class="admin-welcome">
        Bienvenue {{ auth()->user()->name }}
    </p>

    <div class="admin-stats">
        <div class="stat-card">
            <strong>{{ $usersCount }}</strong>
            <span>Utilisateurs</span>
        </div>

        <div class="stat-card">
            <strong>{{ $adminsCount }}</strong>
            <span>Administrateurs</span>
        </div>
    </div>

    <h2>Derniers utilisateurs</h2>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr onclick="openUserModal({{ $user->id }})">
                        <td class="user-link">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Oui' : 'Non' }}</td>
                    </tr>

                    {{-- MODALE USER --}}
                    <div id="user-modal-{{ $user->id }}" class="admin-modal">
                        <div class="admin-modal-content">
                            <span class="close" onclick="closeUserModal({{ $user->id }})">&times;</span>

                            <h3>Profil utilisateur</h3>

                            <p><strong>Nom :</strong> {{ $user->name }}</p>
                            <p><strong>Email :</strong> {{ $user->email }}</p>
                            <p><strong>Admin :</strong> {{ $user->is_admin ? 'Oui' : 'Non' }}</p>
                            <p><strong>Créé le :</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                            <p><strong>Dernière connexion :</strong> {{ $user->last_login_at ?? '—' }}</p>
                            <p><strong>Compte actif :</strong> {{ $user->active ? 'Oui' : 'Non' }}</p>
                            <p><strong>Nombre de rappels :</strong> {{ $user->reminders_count }}</p>


                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@vite('resources/css/admin.css')


<script>
function openUserModal(id) {
    document.getElementById('user-modal-' + id).style.display = 'flex';
}

function closeUserModal(id) {
    document.getElementById('user-modal-' + id).style.display = 'none';
}
</script>
@endsection
