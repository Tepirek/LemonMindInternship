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
- Composer możliwy do pobrania [tutaj](https://getcomposer.org/download/)

## Instrukcja uruchamiania aplikacji
1. pobrać lub sklonować repozytorium
2. utworzyć plik `.env` i wypełnić swoimi danymi jak w pliku `.env.example`
  - uzupełnić własnymi danymi `DB_USERNAME`, `DB_PASSWORD`
  - uzupełnić własnymi danymi zmienne dla [mailtrap.io](https://mailtrap.io/) rozpoczynające się prefixem `MTP_`
3. uruchomić komendę `composer install` w celu pobrania zależności
4. uruchomić serwer webowy w terminalu:
  - `php -S localhost:8080 -t [ścieżka do folderu /web]`
  - przykładowo `php -S localhost:8080 -t ./src/web`
5. uruchomić serwer SQL w terminalu:
  - `mysql -u [username] -p`
  - przykładowo `mysql -u root -p`
6. w terminalu SQL uruchomić jednorazowo komendę, która utworzy bazę oraz tabele:
  - `source [ścieżka do pliku create.sql]`
  - przykładowo `source C:\GitHub\LemonMind2021\config\create.sql`
7. formularz dostępny jest pod adresem `http://localhost:8080/`

### Dodatkowe informacje
  - pod adresem `http://localhost:8080/api/transports` można podejrzeć rekordy z tabeli `transports`
  - pod adresem `http://localhost:8080/api/cargos` można podejrzeć rekordy z tabeli `cargos`
  - w celu zresetowania bazy należy analogicznie do #5. z instrukcji uruchomić:
    - `source [ścieżka do pliku drop.sql]`
    - przykładowo `source C:\GitHub\LemonMind2021\config\drop.sql`
