create database pokemons
    default character set utf8
    collate utf8_unicode_ci;

use pokemons;

CREATE TABLE `pokemon` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `ability` varchar(100) DEFAULT NULL,
  `hp` int DEFAULT NULL,
  `attack` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `pokemon` (`id`, `name`, `type`, `ability`, `hp`, `attack`) VALUES
(1, 'charmander12', 'water', 'firebase', 100, 1600),
(3, 'venusaur', 'grass', 'overgrow', 150, 1350),
(4, 'gyarados', 'flying', 'intimidate', 180, 1450),
(5, 'tyranitar', 'dark', 'sandstream', 200, 1600),
(6, 'gengar', 'ghost', 'levitate', 90, 1500),
(7, 'lucario', 'steel', 'steadfast', 110, 1550),
(8, 'dragonite', 'dragon', 'multiscale', 200, 1700),
(9, 'electivire', 'electric', 'motor drive', 130, 1450),
(10, 'metagross', 'psychic', 'clear body', 180, 1650);


ALTER TABLE `pokemon`
  ADD PRIMARY KEY (`id`);

create user usuarioAPP@localhost
    identified by 'APPpassword';

grant all
    on pokemons.*
    to pokemonuser@localhost;

flush privileges;