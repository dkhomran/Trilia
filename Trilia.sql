-- phpMyAdmin SQL Trilia App
-- version 5.2.0
-- Dekhil Omran
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 24 août 2023 à 18:19
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




--
-- Base de données : `trilia`
--

-- --------------------------------------------------------

--
-- Structure de la table `boards`
--

CREATE TABLE `boards` (
                          `id` bigint(20) UNSIGNED NOT NULL,
                          `team_id` bigint(20) UNSIGNED NOT NULL,
                          `name` varchar(255) NOT NULL,
                          `pattern` varchar(255) NOT NULL,
                          `image_path` varchar(255) DEFAULT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

CREATE TABLE `cards` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `description` varchar(255) DEFAULT NULL,
                         `column_id` bigint(20) UNSIGNED NOT NULL,
                         `previous_id` bigint(20) UNSIGNED DEFAULT NULL,
                         `next_id` bigint(20) UNSIGNED DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `priority` int(11) NOT NULL DEFAULT 0,
                         `type` varchar(255) DEFAULT NULL,
                         `type_color` varchar(255) DEFAULT NULL,
                         `estimated_time` time DEFAULT NULL,
                         `start_date` date DEFAULT NULL,
                         `estimated_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Structure de la table `card_histories`
--

CREATE TABLE `card_histories` (
                                  `id` bigint(20) UNSIGNED NOT NULL,
                                  `card_id` bigint(20) UNSIGNED NOT NULL,
                                  `user_id` bigint(20) UNSIGNED NOT NULL,
                                  `type` enum('comment','event') NOT NULL DEFAULT 'comment',
                                  `content` varchar(255) DEFAULT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Structure de la table `card_user`
--

CREATE TABLE `card_user` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `user_id` bigint(20) UNSIGNED NOT NULL,
                             `card_id` bigint(20) UNSIGNED NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `columns`
--

CREATE TABLE `columns` (
                           `id` bigint(20) UNSIGNED NOT NULL,
                           `name` varchar(255) NOT NULL,
                           `board_id` bigint(20) UNSIGNED NOT NULL,
                           `previous_id` bigint(20) UNSIGNED DEFAULT NULL,
                           `next_id` bigint(20) UNSIGNED DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
                               `id` bigint(20) UNSIGNED NOT NULL,
                               `uuid` varchar(255) NOT NULL,
                               `connection` text NOT NULL,
                               `queue` text NOT NULL,
                               `payload` longtext NOT NULL,
                               `exception` longtext NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
                              `id` int(10) UNSIGNED NOT NULL,
                              `migration` varchar(255) NOT NULL,
                              `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
                                         `email` varchar(255) NOT NULL,
                                         `token` varchar(255) NOT NULL,
                                         `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
                                          `id` bigint(20) UNSIGNED NOT NULL,
                                          `tokenable_type` varchar(255) NOT NULL,
                                          `tokenable_id` bigint(20) UNSIGNED NOT NULL,
                                          `name` varchar(255) NOT NULL,
                                          `token` varchar(64) NOT NULL,
                                          `abilities` text DEFAULT NULL,
                                          `last_used_at` timestamp NULL DEFAULT NULL,
                                          `expires_at` timestamp NULL DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `description` varchar(255) NOT NULL,
                         `image_path` varchar(255) DEFAULT NULL,
                         `pattern` varchar(255) NOT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `password` varchar(255) DEFAULT NULL,
                         `google_id` varchar(255) DEFAULT NULL,
                         `is_active` tinyint(1) NOT NULL DEFAULT 1,
                         `image_path` varchar(255) DEFAULT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `remember_token` varchar(100) DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- --------------------------------------------------------

--
-- Structure de la table `user_team`
--

CREATE TABLE `user_team` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `user_id` bigint(20) UNSIGNED NOT NULL,
                             `team_id` bigint(20) UNSIGNED NOT NULL,
                             `status` enum('Member','Owner','Pending') NOT NULL DEFAULT 'Pending',
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boards`
--
ALTER TABLE `boards`
    ADD PRIMARY KEY (`id`),
  ADD KEY `boards_team_id_foreign` (`team_id`);

--
-- Index pour la table `cards`
--
ALTER TABLE `cards`
    ADD PRIMARY KEY (`id`),
  ADD KEY `cards_column_id_foreign` (`column_id`),
  ADD KEY `cards_previous_id_foreign` (`previous_id`),
  ADD KEY `cards_next_id_foreign` (`next_id`);

--
-- Index pour la table `card_histories`
--
ALTER TABLE `card_histories`
    ADD PRIMARY KEY (`id`),
  ADD KEY `card_histories_card_id_foreign` (`card_id`),
  ADD KEY `card_histories_user_id_foreign` (`user_id`);

--
-- Index pour la table `card_user`
--
ALTER TABLE `card_user`
    ADD PRIMARY KEY (`id`),
  ADD KEY `card_user_user_id_foreign` (`user_id`),
  ADD KEY `card_user_card_id_foreign` (`card_id`);

--
-- Index pour la table `columns`
--
ALTER TABLE `columns`
    ADD PRIMARY KEY (`id`),
  ADD KEY `columns_board_id_foreign` (`board_id`),
  ADD KEY `columns_previous_id_foreign` (`previous_id`),
  ADD KEY `columns_next_id_foreign` (`next_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
    ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `user_team`
--
ALTER TABLE `user_team`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_team_user_id_team_id_unique` (`user_id`,`team_id`),
  ADD KEY `user_team_team_id_foreign` (`team_id`),
  ADD KEY `user_team_user_id_team_id_index` (`user_id`,`team_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boards`
--
ALTER TABLE `boards`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `cards`
--
ALTER TABLE `cards`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `card_histories`
--
ALTER TABLE `card_histories`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `card_user`
--
ALTER TABLE `card_user`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `columns`
--
ALTER TABLE `columns`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user_team`
--
ALTER TABLE `user_team`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `boards`
--
ALTER TABLE `boards`
    ADD CONSTRAINT `boards_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

--
-- Contraintes pour la table `cards`
--
ALTER TABLE `cards`
    ADD CONSTRAINT `cards_column_id_foreign` FOREIGN KEY (`column_id`) REFERENCES `columns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cards_next_id_foreign` FOREIGN KEY (`next_id`) REFERENCES `cards` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cards_previous_id_foreign` FOREIGN KEY (`previous_id`) REFERENCES `cards` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `card_histories`
--
ALTER TABLE `card_histories`
    ADD CONSTRAINT `card_histories_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `card_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `card_user`
--
ALTER TABLE `card_user`
    ADD CONSTRAINT `card_user_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `card_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `columns`
--
ALTER TABLE `columns`
    ADD CONSTRAINT `columns_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `columns_next_id_foreign` FOREIGN KEY (`next_id`) REFERENCES `columns` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `columns_previous_id_foreign` FOREIGN KEY (`previous_id`) REFERENCES `columns` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `user_team`
--
ALTER TABLE `user_team`
    ADD CONSTRAINT `user_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`),
  ADD CONSTRAINT `user_team_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

