class Item {
  final int id; // Unique ID for each item
  final String name; // Name of the item
  final double price; // Price of the item
  int quantity; // Quantity of the item

  Item({
    required this.id, // Required parameters untuk id
    required this.name, // Required parameters untuk name
    required this.price, // Required parameters untuk price
    this.quantity = 1, // Default quantity = 1
  });
}
