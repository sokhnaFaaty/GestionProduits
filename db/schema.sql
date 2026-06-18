-- Schéma PostgreSQL pour GestionProduits
-- Créer la base d'abord : createdb ProduitGestiongroupeFaty
-- Puis exécuter ce fichier : psql -U postgres -d ProduitGestiongroupeFaty -f schema.sql

-- Clients
CREATE TABLE IF NOT EXISTS client (
    id        SERIAL PRIMARY KEY,
    nom       VARCHAR(100) NOT NULL,
    prenom    VARCHAR(100) NOT NULL,
    telephone VARCHAR(20)  NOT NULL UNIQUE,
    email     VARCHAR(150)
);

-- Produits
CREATE TABLE IF NOT EXISTS produit (
    id_produit     SERIAL PRIMARY KEY,
    libelle        VARCHAR(200) NOT NULL,
    prix           NUMERIC(10, 2) NOT NULL CHECK (prix >= 0),
    quantite_stock INTEGER NOT NULL DEFAULT 0 CHECK (quantite_stock >= 0),
    image          VARCHAR(255) DEFAULT NULL
);

-- Commandes
CREATE TABLE IF NOT EXISTS commande (
    id_commande  SERIAL PRIMARY KEY,
    id_client    INTEGER NOT NULL REFERENCES client(id) ON DELETE RESTRICT,
    date_commande TIMESTAMP NOT NULL DEFAULT NOW(),
    statut       VARCHAR(50) NOT NULL DEFAULT 'en attente',
    montant_total NUMERIC(10, 2) NOT NULL DEFAULT 0
);

-- Lignes de commande
CREATE TABLE IF NOT EXISTS ligne_commande (
    id_ligne     SERIAL PRIMARY KEY,
    id_commande  INTEGER NOT NULL REFERENCES commande(id_commande) ON DELETE CASCADE,
    id_produit   INTEGER NOT NULL REFERENCES produit(id_produit) ON DELETE RESTRICT,
    quantite     INTEGER NOT NULL CHECK (quantite > 0),
    prix_unitaire NUMERIC(10, 2) NOT NULL CHECK (prix_unitaire >= 0)
);
