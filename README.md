# Acme Widget Co
### Overview
A proof-of-concept shopping basket system for Acme Widget Co. This system was built using **modern PHP architecture principles** such as Dependency Injection, the Strategy Pattern, and strong encapsulation to ensure code quality and maintainability.

### Architecture Overview

This solution is designed with the following principles:

-  **Dependency Injection**: All core components (catalogue, offers, delivery rules) are injected into the basket class.
-  **Strategy Pattern**: Used to handle different offer and delivery strategies in a modular way.
-  **Encapsulation**: Each class has a single responsibility and clean, typed interfaces.
-  **Testability**: The system is fully testable with PHPUnit.
-  **Extensibility**: New offers or delivery methods can be implemented and plugged in without modifying existing logic.

###  Features

- Setup products catalogue (e.g. Red widget(R01), Green widget(G01), Blue widget(B01))
- Add items to a basket using product codes (`R01`, `G01`, `B01`)
- Compute subtotal and apply:
    - Delivery cost based on total amount
    - Special offers( the initial offer is limited to Red widget )
- Calculate and return final total

### Product Catalogue

| Product Code | Name         | Price  |
|--------------|--------------|--------|
| `R01`        | Red Widget   | $32.95 |
| `G01`        | Green Widget | $24.95 |
| `B01`        | Blue Widget  | $7.95  |

### Delivery Rules

- Orders **under $50** → $4.95 delivery
- Orders **$50 - $89.99** → $2.95 delivery
- Orders **$90 or more** → Free delivery

### Special Offers
_Buy One Red Widget (R01), Get Second at Half Price_

This promotion gives a 50% discount on the second red widgets purchased.

- 1st at full price
- 2nd at 50%
- 3rd at full price
- 4th at full price, etc.

### Example Baskets

| Basket Items                   | Expected Total |
|--------------------------------|----------------|
| `B01, G01`                     | `$37.85`       |
| `R01, R01`                     | `$54.37`       |
| `R01, G01`                     | `$60.85`       |
| `B01, B01, R01, R01, R01`      | `$98.27`       |

### Assumptions
- Assumed all product, offer, and delivery data is stored in memory for the proof of concept
- Offers apply only to product R01 (Red Widget) as specified.
- Product codes must match exactly; otherwise, an error is thrown.
- Catalogue, offers, and delivery charge are fixed in memory for this proof-of-concept.
- Total is rounded to 2 decimal places.

## Setup and Installation

### Requirements
- Docker 
  - PHP 8.4
- PHPstan
- PHPUnit

### Install
There's a Makefile that makes it easy to execute each of the commands.
```bash
make up
```

### Unit Test
```bash
make test
```
### Code analysis
```bash
make stan
```
### Test the app
This executes 2 order of Red widget as a sample
```bash
make app
```
