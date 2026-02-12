# Esame di verifica (2 ore) — Testing con PHP (PHPUnit)

## Contesto
Questo progetto contiene un piccolo “mini gestionale biblioteca” **in memoria** (niente DB).
Il software è già funzionante; il tuo compito è scrivere test automatici con PHPUnit.

## Obiettivo
Completare la suite di test in modo da coprire **le regole di business principali**.

- Una parte dei test è **già presente** (validazioni base).
- Una parte dei test è **da scrivere** (in particolare per `LoanService` e `InMemoryLoanRepository`).

## Cosa è consentito
✅ Aggiungere/modificare file in `tests/`
✅ Aggiungere provider/dataset e usare buone pratiche (Arrange-Act-Assert, nomi chiari, ecc.)
✅ Aggiungere classi helper **solo nei test** se serve (es. factory test)

🚫 Non modificare il codice in `src/` (salvo errori di sintassi o compatibilità ambiente).
L’esame valuta la capacità di testare codice esistente.

## Setup rapido
```bash
composer install
composer test
```

## Requisiti di consegna
1. Tutti i test devono passare.
2. Aggiungere i test mancanti indicati sotto.
3. Target consigliato: **copertura ragionevole** sulle regole di business (non serve 100%).

## Compiti (cosa devi testare)

### A) `LoanService` (DA TESTARE)
File: `src/Service/LoanService.php`

Regole:
1. **Prestito riuscito**: `borrow()` crea un `Loan` con:
   - `loanedAt` uguale alla data passata
   - `dueAt` uguale a `loanedAt + 14 giorni`
   - `returnedAt` inizialmente `null`
2. **Libro già in prestito**: se il libro è già in prestito (prestito attivo), `borrow()` lancia `DomainException`.
3. **Limite prestiti attivi**: un membro non può avere più di **3** prestiti attivi; al 4° `borrow()` lancia `DomainException`.
4. **Riconsegna**: `returnBook()` imposta `returnedAt` e rende il prestito non più “attivo”.
5. **Overdue**:
   - Un prestito è overdue se `today > dueAt` e non è stato restituito.
   - Se è stato restituito, **non** è overdue.

> Suggerimento: qui ci sono molte combinazioni interessanti. Non servono decine di test: bastano quelli “giusti”.

### B) `InMemoryLoanRepository` (DA TESTARE)
File: `src/Repository/InMemoryLoanRepository.php`

Comportamenti:
1. `save()` memorizza il prestito.
2. `activeLoanForBook()` ritorna il prestito attivo del libro (o `null`).
3. `activeLoansForMember()` ritorna solo i prestiti attivi del membro.

### C) Già testato (NON serve aggiungere altro, salvo vuoi)
- `Book` validazione ISBN
- `Member` validazione email
