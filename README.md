# Hi
Here comes my solution for TrackTik PHP Backend challange. I have separated the main classes to make it easier to view them on screen.

### Coding Style
I tried to apply the PSR-2 conceptions along with part of SOLID elements.

### Premises/Considerations
1. There must be an extras number validation
2. Controllers can have their own price
3. Controller price is added to product price in "total price calculation"

## Bug fixed from original code
1. Sorting by price function returns bool value
2. Sorting by price function merges items with same value

## Scenarios
#### Console
- Price 500
- Wired controllers 2x 25
- Remote controllers 2x 60
- Total Price 670
#### TV 1
- Price 900
- Remote controllers 2x20
- Total Price 940
#### TV 2
- Price 400
- Remote controllers 20
- Total Price 420
#### Microwave
- Price 90
- Total Price 90
#### Total
2120
