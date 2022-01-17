## Jak spustit projekt

Pro správné spuštění je třeba mít nainstalovaný composer, docker a balíčkovač npm.

První příkaz, který je potřeba spustit je:

``composer install``

Po tomto příkazu nainstalujeme balíčky pro frontend:

``npm install``

a zkompilujeme všechny soubory, abychom měli připravné prostředí:

``npm run dev``

Předtím, než spustíme docker a server, je třeba vytvořit ``.env`` soubor. To jednoduše uděláme ze souboru ``.env.example``

Po vytvoření config souboru spustíme server pomocí dockeru a pomocného balíčku sail:

``./vendor/bin/sail up -d``

Po spuštění serveu je třeba vytvořit databázi. Databázi vytvoříme ručně přes adminera. Toho najdeme na url [localhost:8080](http://localhost:8080). Zde se přihlásíme:

``
username: root 
password: password
``

Vytvoříme databázi podle ``.env`` config souboru. (twitter_app)

Poté, co bude databáze vytvořena, spustíme migrace:

``sail artisan migrate``

Nyní navštívíme nastavení aplikace [localhost/settings/](http://localhost/settings/). Vyplníme všechny pole, abychom měli přístup k tweetům.

Po uložení všech polí, stačí přejít na úvodní stránku [http://localhost/](http://localhost/), vyplnit pole a vyhledat.
Pro zrušení filtru, stačí kliknout na štítek s textem filtru, který chceme zrušit.

Pokud nechceme react aplikaci, ale čistě php, pak je na url [http://localhost/tweets/](http://localhost/tweets/)
