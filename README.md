# Projekt: API pro práci s objednávkami

Demonstrační REST API pro správu objednávek se zaměřením na strukturu dat, identifikátory a oddělení entit.



## Datová struktura

Hlavní entitou je `Order`, která reprezentuje jednotlivé objednávky. 
Zejména je důležité rozlišovat mezi dvěma identifikátory:
- **id** (`int`): Interní primární klíč databáze s automatickým inkrementem. Slouží výhradně pro potřeby ORM (např. Doctrine) a není určen pro externí použití.
  - **Při migracích nebo přenosech dat může dojít ke změně hodnoty `id`, proto by neměl být používán jako veřejný identifikátor.**


- **orderId** (`string`, UUID): Externí unikátní identifikátor objednávky.
  - Slouží k jednoznačné identifikaci objednávky mimo databázi.
  - Je bezpečnější než inkrementální ID (např. není snadné uhodnout další objednávku).


Objednávka obsahuje odkaz na entitu `Currency`, která reprezentuje měnu a umožňuje její snadné rozšíření.

Podobně je `OrderStatus` samostatná entita, aby bylo možné flexibilně spravovat stav objednávky.

Celková částka (`amount`) objednávky téměř nikdy není pouhým součtem cen jednotlivých položek — obvykle se počítá samostatně podle specifické obchodní logiky, která zahrnuje například dopravu nebo slevové kódy.



---

### OrderItem

`OrderItem` uchovává kopii údajů o produktu v době objednání (např. název, cenu, množství), nikoli pouze odkaz na `Product`.  
Díky tomu objednávka zůstává konzistentní i po změně nebo smazání produktu — což zajišťuje datovou nezávislost a historickou přesnost.
## Funkce API

API umožňuje následující operace:
- Získání seznamu všech objednávek
- Detail objednávky podle `orderId`
- Zobrazení seznamu a detailu produktů (`Product`) — pro ukázku rozdílu oproti položkám objednávky (`OrderItem`), které uchovávají kopie dat produktu v době objednání


CRUD operace pro `Order` nebyly implementovány záměrně, protože stav objednávky by neměl být měněn ručně. I když jde o demo aplikaci, ve skutečnosti se stav objednávky obvykle mění automatizovaně systémem, nikoli uživatelem.



---

## Požadavky

Pro spuštění projektu stačí mít nainstalovaný:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

Aplikaci lze spustit jedním příkazem:

```bash
docker-compose up --build -d
```