# LemonMindInternship

## Wykonane zadania
- [x] formularz
- [x] dodawania ładunków
- [x] zadanie nr 3
- [x] wysyłanie danych na pocztę
- [x] zmienne środowiskowe w pliku `.env`
- [x] zadanie nr 4
- [x] dodawanie rekordów do bazy danych
- [x] REST-ishowa API-ishowa walidacja i przesyłanie formularza
 
## Wymagania konfiguracyjne
- PHP możliwy do pobrania [tutaj](https://www.php.net/downloads.php)
- MYSQL możliwy do pobrania [tutaj](https://dev.mysql.com/downloads/)

## Instrukcja uruchamiania aplikacji
1. pobrać lub sklonować repozytorium
2. utworzyć plik `.env` i wypełnić swoimi danymi jak w pliku `.env.example`
  - uzupełnić własnymi danymi `DB_USERNAME`, `DB_PASSWORD`
  - uzupełnić własnymi danymi zmienne dla [mailtrap.io](https://mailtrap.io/) rozpoczynające się prefixem `MTP_`
3. uruchomić serwer webowy w terminalu:
  - `php -S localhost:8080 -t [ścieżka do folderu /web]`
  - przykładowo `php -S localhost:8080 -t ./src/web`
4. uruchomić serwer SQL w terminalu:
  - `mysql -u [username] -p`
  - przykładowo `mysql -u root -p`
5. w terminalu SQL uruchomić jednorazowo komend, która utworzy bazę oraz tabele:
  - `source [ścieżka do pliku create.sql]`
  - przykładowo `source C:\GitHub\LemonMind2021\config\create.sql`
6. formularz dostępny jest pod adresem `http://localhost:8080/`

### Dodatkowe informacje
