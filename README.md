Abstract assigment

● Servis mora da omogući korisniku da može da kreira projekte kroz UI i da se po projektu
doda jedan ili vise SMTP provajdera za slanje. Razmisliti prilikom implementacije da u
budućnosti može da se doda i drugi driver pored SMTP-a, npr. Mailgun;

● Obavezno je da na nivou projekta postoji default mail provajder koji se koristi;

● Na nivou projekta omogućiti korisniku da doda URL adresu za webhook koji ce se
koristiti da obavesti korisnika ukoliko je job zavrsio u failed_jobs tabeli i isto tako
omogućiti korisniku da izabere da li zeli webhook da dobije u JSON ili XML formatu.
Prilikom implementacije razmisliti da u budućnosti može da se doda drugi format;
● Po projektu korisnik može da kreira više e-mail template kroz UI;

● Komunikacija sa servisom se odvija kroz REST API;
    ○ Primer: [POST] http://localhost/api/send-email
        {
            "driver": string,
            "template": string,
            "params": [ ]
        }

● Dokumentovati API kroz Swagger ili drugi alat za API docs;

● Dokerizovati aplikaciju i dokumentovati kako se radi setup aplikacije;

● Slanje emailova uraditi kroz queue;

● Podesiti queue da pokuša slanje emailova 3x, a da pauza između svakog pokušaja bude
30 sekundi, a ako ne uspe iz trećeg pokušaja, onda poslati email job u failed_jobs tabelu
i poslati podatke o dogadjaju na webhook URL.
