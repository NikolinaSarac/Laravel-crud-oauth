# HTTP Basic Authentication - Upute za korištenje

Za pristup REST API endpointima, implementirana je zaštita putem HTTP Basic Auth.

## Testni korisnički račun

- **Email:** test@test.com
- **Lozinka:** tajna123

## Korištenje u Postman-u

1. Otvorite Postman.
2. Odaberite HTTP metodu (GET, POST, PUT, DELETE).
3. Upišite URL API rute, npr.:  
   `http://localhost:8000/api/customers`
4. Idite na tab **Authorization**.
5. Izaberite **Basic Auth** kao tip autorizacije.
6. U polja upišite:
    - **Username:** `test@test.com`
    - **Password:** `tajna123`
7. Kliknite **Send**.

Ako su podaci ispravni, API će dopustiti pristup i vratiti JSON odgovor.
U suprotnom, vraća se status `401 Unauthorized`.

---

## Napomena

- Basic Auth koristi email kao korisničko ime, a lozinku koju ste unijeli prilikom registracije.
- Ova metoda koristi se samo za demo/testiranje i nije preporučena za produkcijsko okruženje bez dodatne HTTPS zaštite.
