# petshop-website

Projet de **site web de vente de produits pour animaux**.
Il a été réalisé en binôme avec Mohamed Ibrir en 2024 sans utiliser git.

---

# Prérequis

Pour utiliser ce site, vous aurez besoin de :

* Un **navigateur web**
* Un **serveur local** supportant **PHP** et un **SGBD SQL**
  (par exemple XAMPP)

---

# Installation du site avec XAMPP

## 1. Installation de XAMPP

Installez XAMPP et assurez-vous que les modules suivants sont installés :

* **Apache**
* **MySQL**
* **PHP**

Lors de l'installation, le dossier par défaut est généralement :

```
C:\xampp
```

---

## 2. Déploiement du site sur le serveur local

Le dossier **`site`** (situé au même niveau que ce README) doit être placé dans le dossier :

```
C:\xampp\htdocs
```

Si vous avez installé XAMPP dans un autre dossier, adaptez le chemin en conséquence.

---

## 3. Mise en place de la base de données

1. Ouvrez le **XAMPP Control Panel**.

2. Démarrez les services :

   * **Apache**
   * **MySQL**

3. Dans votre navigateur, accédez à :

```
http://localhost/phpmyadmin/
```

(Interface de gestion de base de données fournie par phpMyAdmin)

4. Dans le panneau de gauche :

   * Cliquez sur **Nouvelle base de données**
   * Donnez-lui le nom :

```
projet
```

5. Cliquez sur **Créer**.

6. Une fois la base créée :

   * Allez dans l’onglet **Importer**
   * Sélectionnez le fichier :

```
BDD.sql
```

(se trouvant dans le même dossier que ce README)

7. Cliquez sur **Importer**.

---

## 4. Accéder au site

Une fois la base de données importée :

1. Vérifiez que **Apache** et **MySQL** sont démarrés dans XAMPP.
2. Ouvrez votre navigateur et allez à l'adresse :

```
http://localhost/site/
```

---

# Types de comptes

Le site propose **trois types de comptes** :

### Client

Un client peut :

* Acheter des produits
* Evaluer les produits déjà acheté
* Mettre un commentaire aux produits déjà acheté

### Vendeur

Un vendeur peut :

* Mettre des produits en vente
* Modifier les produits déjà publiés

### Administrateur

Un administrateur peut :

* Supprimer des utilisateurs
* Supprimer des produits
* Gérer les comptes clients

---

# Compte administrateur

Normalement, la création d’un compte administrateur nécessite un **code secret**.
Malheureusement, ce code a été perdu.

Pour tester les fonctionnalités administrateur, vous pouvez utiliser le compte suivant :

```
Identifiant : TheAdmin
Mot de passe : TheAdmin
```

---

# Comptes existants

Vous pouvez également vous connecter avec n'importe quel compte présent dans la base de données.

⚠️ Pour simplifier les tests :

```
Identifiant = mot de passe
```

---

# Utilisation des fonctionnalités

### Vendeur et Administrateur

Les fonctionnalités spécifiques sont accessibles depuis la **page de profil** une fois connecté.

### Client

Le client peut acheter des produits comme sur un **site e-commerce classique** :

1. Parcourir les produits
2. Ajouter des articles au panier
3. Finaliser l’achat