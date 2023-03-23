
# LV2 - Napredno programiranje

Zadatak 1:
Napravite skriptu koja će napraviti backup baze podataka, spremiti ga u .txt datoteku i nakon toga sažeti
dobivenu .txt datoteku. Format zapisa podataka u datoteku treba biti:
INSERT INTO nazivTablice (atribut1, atribut2, atribut3)
VALUES ('vrijednost1', 'vrijednost2', 'vrijednost3)";
INSERT INTO nazivTablice (atribut1, atribut2, atribut3)
VALUES ('vrijednost1', 'vrijednost2', 'vrijednost3)"; 

---> db_backup.php 

Zadatak 2:
Napraviti skriptu koja će omogućiti upload dokumenta ili slike (pdf, jpeg,png) i kriptiranje dokumenta
pomoću biblioteke OpenSSL. Na serveru treba biti uploadan samo kriptirani dokument. Napraviti skriptu
koja će dohvatiti sve kriptirane dokumente, dekriptirati ih i prikazati linkove za preuzimanje dokumenata.

---> media_reader.php, media_uploader.php, download.php, encrypt_functions.php

Zadatak 3:
Napraviti skriptu koja će parsirati XML datoteku LV2.xml. U XML datoteci se nalazi popis od 100 osoba sa
podacima (id,ime,prezime,email,spol,slika,zivotopis). Od dobivenih podataka napraviti profil osobe sa
prikazom slike, imena, prezimena, email-a i životopisa.

---> parser.php, profile_all.php, profile_show.php

 



