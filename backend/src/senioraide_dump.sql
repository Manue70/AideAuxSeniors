--
-- PostgreSQL database dump
--

\restrict TLYteAs3JJ2svSe3RwKE1eNGaiBLGeDCv9hAvZ0I6o2WLEmBJQI4YZOXZ5RwoHQ

-- Dumped from database version 15.15 (Debian 15.15-1.pgdg13+1)
-- Dumped by pg_dump version 17.7 (Debian 17.7-0+deb13u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: assistant_messages; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.assistant_messages (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    role character varying(255) NOT NULL,
    content text NOT NULL,
    is_sensitive boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT assistant_messages_role_check CHECK (((role)::text = ANY ((ARRAY['user'::character varying, 'assistant'::character varying])::text[])))
);


ALTER TABLE public.assistant_messages OWNER TO "user";

--
-- Name: assistant_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.assistant_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.assistant_messages_id_seq OWNER TO "user";

--
-- Name: assistant_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.assistant_messages_id_seq OWNED BY public.assistant_messages.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO "user";

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO "user";

--
-- Name: contacts; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.contacts (
    id bigint NOT NULL,
    nom character varying(255) NOT NULL,
    telephone character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.contacts OWNER TO "user";

--
-- Name: contacts_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.contacts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.contacts_id_seq OWNER TO "user";

--
-- Name: contacts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.contacts_id_seq OWNED BY public.contacts.id;


--
-- Name: emergency_contacts; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.emergency_contacts (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    nom character varying(255) NOT NULL,
    telephone character varying(255) NOT NULL,
    lien character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.emergency_contacts OWNER TO "user";

--
-- Name: emergency_contacts_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.emergency_contacts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.emergency_contacts_id_seq OWNER TO "user";

--
-- Name: emergency_contacts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.emergency_contacts_id_seq OWNED BY public.emergency_contacts.id;


--
-- Name: medications; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.medications (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    nom character varying(255) NOT NULL,
    dosage character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.medications OWNER TO "user";

--
-- Name: medications_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.medications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.medications_id_seq OWNER TO "user";

--
-- Name: medications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.medications_id_seq OWNED BY public.medications.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO "user";

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO "user";

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: profiles; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.profiles (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    prenom character varying(255),
    birthday date,
    gender character varying(255),
    theme_accueil character varying(255),
    accessibilite text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    telephone character varying(20)
);


ALTER TABLE public.profiles OWNER TO "user";

--
-- Name: profiles_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.profiles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.profiles_id_seq OWNER TO "user";

--
-- Name: profiles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.profiles_id_seq OWNED BY public.profiles.id;


--
-- Name: reminders; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.reminders (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    type character varying(255) NOT NULL,
    message character varying(255) NOT NULL,
    heure time(0) without time zone NOT NULL,
    est_effectue boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.reminders OWNER TO "user";

--
-- Name: reminders_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.reminders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.reminders_id_seq OWNER TO "user";

--
-- Name: reminders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.reminders_id_seq OWNED BY public.reminders.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO "user";

--
-- Name: users; Type: TABLE; Schema: public; Owner: user
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    onboarding_completed boolean DEFAULT false NOT NULL,
    is_admin boolean DEFAULT false NOT NULL,
    name character varying(255)
);


ALTER TABLE public.users OWNER TO "user";

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: user
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO "user";

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: user
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: assistant_messages id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.assistant_messages ALTER COLUMN id SET DEFAULT nextval('public.assistant_messages_id_seq'::regclass);


--
-- Name: contacts id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.contacts ALTER COLUMN id SET DEFAULT nextval('public.contacts_id_seq'::regclass);


--
-- Name: emergency_contacts id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.emergency_contacts ALTER COLUMN id SET DEFAULT nextval('public.emergency_contacts_id_seq'::regclass);


--
-- Name: medications id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.medications ALTER COLUMN id SET DEFAULT nextval('public.medications_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: profiles id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.profiles ALTER COLUMN id SET DEFAULT nextval('public.profiles_id_seq'::regclass);


--
-- Name: reminders id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.reminders ALTER COLUMN id SET DEFAULT nextval('public.reminders_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: assistant_messages; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.assistant_messages (id, user_id, role, content, is_sensitive, created_at, updated_at) FROM stdin;
1	2	user	bonjour	f	2026-01-20 11:02:06	2026-01-20 11:02:06
2	2	assistant	Bonjour ! Comment puis-je vous aider aujourd'hui ?	f	2026-01-20 11:02:16	2026-01-20 11:02:16
3	2	user	je vais bien merci,	f	2026-01-20 11:02:30	2026-01-20 11:02:30
4	2	assistant	Je suis ravi de l'entendre ! Si tu as envie de discuter ou si tu as des questions, n'hésite pas à me le faire savoir.	f	2026-01-20 11:02:32	2026-01-20 11:02:32
5	2	user	peut tu me conseiller un endroit pour me reposer , j'ai une semaine de congé	f	2026-01-20 11:03:09	2026-01-20 11:03:09
6	2	assistant	Bien sûr ! Voici quelques suggestions d'endroits où tu pourrais te reposer pendant ta semaine de congé :\n\n1. **Plage** : Si tu aimes la mer, envisage de passer du temps sur une plage. Que ce soit en France (comme la Côte d'Azur, la Bretagne ou les plages des Landes) ou à l'étranger (comme les îles grecques ou les plages de Thaïlande), tu pourras profiter du soleil et te détendre au bord de l'eau.\n\n2. **Montagne** : Pour un séjour plus frais et paisible, les montagnes sont une excellente option. Que ce soit dans les Alpes, les Pyrénées ou même en Écosse, tu pourras profiter de randonnées, de paysages magnifiques et d'un air pur.\n\n3. **Spa ou centre de bien-être** : Réserve quelques jours dans un hôtel avec un spa. Cela te permettra de profiter de traitements relaxants, de massages et d'autres soins apaisants pour te ressourcer.\n\n4. **Campagne** : Louer un gîte ou un cottage à la campagne peut être une belle façon de se déconnecter. Profite de la nature, fais des balades et savoure des moments de tranquillité.\n\n5. **Séjour en ville** : Si tu préfères être en ville, choisis une destination qui t'intéresse, comme Paris, Barcelone, Lisbonne ou Rome. Explore les musées, déguste la cuisine locale et prends le temps de te poser dans des cafés.\n\n6. **Retraite de yoga** : Si tu souhaites te recentrer et te ressourcer, une retraite de yoga peut être idéale. Cela te permettra de te détendre tout en pratiquant des exercices de bien-être.\n\nChoisis l'option qui te convient le mieux selon tes envies et tes préférences ! Et n'oublie pas de prendre le temps de te détendre pleinement.	f	2026-01-20 11:03:17	2026-01-20 11:03:17
7	2	user	Réponds-moi de manière simple, sans utiliser de numéros, d’astérisques ou de Markdown, juste du texte brut.	f	2026-01-20 11:05:33	2026-01-20 11:05:33
8	2	assistant	Bien sûr, je peux répondre de cette façon. Que souhaites-tu savoir ?	f	2026-01-20 11:05:35	2026-01-20 11:05:35
9	2	user	quelle option me conseille tu de celles que tu m'as donner stp	f	2026-01-20 11:06:05	2026-01-20 11:06:05
10	2	assistant	Bien sûr, je serais ravi de t'aider à choisir une option ! Peux-tu me rappeler de quelles options il s'agit ou me donner plus de détails sur ce que tu cherches ? Cela m'aidera à te donner le meilleur conseil possible.	f	2026-01-20 11:06:07	2026-01-20 11:06:07
11	2	user	sur les options de vacances que tu m'as donner plus haut	f	2026-01-20 11:06:36	2026-01-20 11:06:36
12	2	assistant	Je crains de ne pas avoir accès à l'historique des conversations précédentes. Pourrais-tu s'il te plaît me rappeler les options de vacances dont tu parlais ? Je serais ravi de t'aider à les explorer ou à te donner des conseils !	f	2026-01-20 11:06:39	2026-01-20 11:06:39
13	2	user	te souvient tu de tes conseils ?	f	2026-01-20 11:16:44	2026-01-20 11:16:44
14	2	assistant	Oui, je me souviens. Les conseils étaient d'aller à la plage, en montagne, dans un spa, à la campagne, en ville, ou de faire une retraite de yoga. Si tu cherches un endroit pour te reposer, je te recommande une plage ou un séjour à la campagne. Ces options sont souvent très relaxantes et te permettent de te ressourcer. Qu'en penses-tu ?	f	2026-01-20 11:16:48	2026-01-20 11:16:48
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: contacts; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.contacts (id, nom, telephone, created_at, updated_at) FROM stdin;
1	Docteur Neon	+33 5 01 01 01 01	2026-01-20 10:32:09	2026-01-20 10:32:09
2	Ma fille	+33 5 02 02 02 02	2026-01-20 10:32:10	2026-01-20 10:32:10
3	pharmacie Tchichi	+33 5 03 03 03 03	2026-01-20 10:32:10	2026-01-20 10:32:10
4	titi	+33 5 01 01 01 01	2026-01-20 11:23:28	2026-01-20 11:23:28
5	toto	+33 5 02 03 014 01	2026-01-20 11:23:28	2026-01-20 11:23:28
\.


--
-- Data for Name: emergency_contacts; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.emergency_contacts (id, user_id, nom, telephone, lien, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: medications; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.medications (id, user_id, nom, dosage, created_at, updated_at) FROM stdin;
1	2	vit E	3	2026-01-20 10:31:07	2026-01-20 10:31:07
2	2	vit E	3	2026-01-20 10:33:14	2026-01-20 10:33:14
3	2	vit B	3	2026-01-20 11:00:20	2026-01-20 11:00:20
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.migrations (id, migration, batch) FROM stdin;
13	2026_01_03_180000_create_users_table	1
14	2026_01_03_181210_create_profiles_table	1
15	2026_01_03_181222_create_medications_table	1
16	2026_01_03_181232_create_reminders_table	1
17	2026_01_03_181242_create_emergency_contacts_table	1
18	2026_01_06_134806_create_sessions_table	1
19	2026_01_06_151849_create_cache_table	1
20	2026_01_09_150932_add_onboarding_completed_to_users_table	1
21	2026_01_13_125255_add_is_admin_to_users_table	1
22	2026_01_13_125630_add_name_to_users_table	1
23	2026_01_14_135910_create_contacts_table	1
24	2026_01_15_115014_add_telephone_to_profiles_table	1
25	2026_01_16_122001_create_assistant_messages_table	1
\.


--
-- Data for Name: profiles; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.profiles (id, user_id, prenom, birthday, gender, theme_accueil, accessibilite, created_at, updated_at, telephone) FROM stdin;
1	2	John Doe	\N	\N	\N	\N	2026-01-20 11:19:23	2026-01-20 11:19:23	+33 5 05 05 05 05
\.


--
-- Data for Name: reminders; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.reminders (id, user_id, type, message, heure, est_effectue, created_at, updated_at) FROM stdin;
4	2	hydratation	boire 4 verres d'eau dans la journée	12:00:00	f	2026-01-20 10:47:20	2026-01-20 10:47:20
5	2	hydratation	boire 4 verres d'eau dans la journée	20:00:00	f	2026-01-20 10:47:20	2026-01-20 10:47:20
7	2	hydratation	boire 4 verres d'eau dans la journée	12:00:00	f	2026-01-20 10:53:13	2026-01-20 10:53:13
8	2	hydratation	boire 4 verres d'eau dans la journée	20:00:00	f	2026-01-20 10:53:13	2026-01-20 10:53:13
9	2	hydratation	boire 4 verres d'eau dans la journée	08:00:00	f	2026-01-20 10:58:47	2026-01-20 10:58:47
10	2	hydratation	boire 4 verres d'eau dans la journée	12:00:00	f	2026-01-20 10:58:47	2026-01-20 10:58:47
11	2	hydratation	boire 4 verres d'eau dans la journée	20:00:00	f	2026-01-20 10:58:47	2026-01-20 10:58:47
12	2	médicament	Prendre vit B (3)	08:00:00	f	2026-01-20 11:00:20	2026-01-20 11:00:20
1	2	médicament	Prendre vit E (3)	08:00:00	f	2026-01-20 10:31:07	2026-01-20 11:00:51
2	2	médicament	Prendre vit E (3)	08:00:00	t	2026-01-20 10:33:15	2026-01-20 11:01:04
6	2	hydratation	boire 4 verres d'eau dans la journée	08:00:00	t	2026-01-20 10:53:13	2026-01-20 11:01:09
3	2	hydratation	boire 4 verres d'eau dans la journée	08:00:00	t	2026-01-20 10:47:20	2026-01-20 11:01:16
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: user
--

COPY public.users (id, email, password, created_at, updated_at, onboarding_completed, is_admin, name) FROM stdin;
1	admin@example.com	$2y$12$1FGkit1ua0mY0gZhhynQFuus4EjawAsseBG..sCvpHr1.AbX3EoZ2	2026-01-18 14:14:54	2026-01-18 14:14:54	f	t	Admin
3	user2@example.com	$2y$12$/mxUsqfnp7X0B.fHOwNsCuh8Uhw36Y8xNwRB3Fodbc4ysdQv2HRdm	2026-01-18 14:23:07	2026-01-18 14:23:07	f	f	Utilisateur Test 2
2	user1@example.com	$2y$12$FQmEdvAdg8qMJ6M8gRz2a.hewncoCodt7cHMY.XIjVYbaGg3tkbBq	2026-01-18 14:23:07	2026-01-20 10:32:17	t	f	Utilisateur Test 1
\.


--
-- Name: assistant_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.assistant_messages_id_seq', 14, true);


--
-- Name: contacts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.contacts_id_seq', 5, true);


--
-- Name: emergency_contacts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.emergency_contacts_id_seq', 1, false);


--
-- Name: medications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.medications_id_seq', 4, true);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.migrations_id_seq', 25, true);


--
-- Name: profiles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.profiles_id_seq', 1, true);


--
-- Name: reminders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.reminders_id_seq', 16, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: user
--

SELECT pg_catalog.setval('public.users_id_seq', 4, true);


--
-- Name: assistant_messages assistant_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.assistant_messages
    ADD CONSTRAINT assistant_messages_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: contacts contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_pkey PRIMARY KEY (id);


--
-- Name: emergency_contacts emergency_contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.emergency_contacts
    ADD CONSTRAINT emergency_contacts_pkey PRIMARY KEY (id);


--
-- Name: medications medications_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.medications
    ADD CONSTRAINT medications_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: profiles profiles_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_pkey PRIMARY KEY (id);


--
-- Name: reminders reminders_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.reminders
    ADD CONSTRAINT reminders_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: user
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: assistant_messages assistant_messages_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.assistant_messages
    ADD CONSTRAINT assistant_messages_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: emergency_contacts emergency_contacts_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.emergency_contacts
    ADD CONSTRAINT emergency_contacts_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: medications medications_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.medications
    ADD CONSTRAINT medications_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: profiles profiles_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.profiles
    ADD CONSTRAINT profiles_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: reminders reminders_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: user
--

ALTER TABLE ONLY public.reminders
    ADD CONSTRAINT reminders_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict TLYteAs3JJ2svSe3RwKE1eNGaiBLGeDCv9hAvZ0I6o2WLEmBJQI4YZOXZ5RwoHQ

