import 'package:flutter/foundation.dart';
import 'item.dart'; // Pastikan import ini ada

class CartModel extends ChangeNotifier {
  final List<Item> _items = []; // List item yang ada di keranjang

  List<Item> get items => _items; // Getter untuk mendapatkan item

  double get totalPrice => _items.fold(
    0,
    (total, item) => total + (item.price * item.quantity),
  ); // Getter untuk mendapatkan total harga

  void add(Item item) {
    // Method untuk menambah item ke keranjang
    final index = _items.indexWhere(
      (element) => element.id == item.id,
    ); // Cari index item
    if (index != -1) {
      // Cek apakah item sudah ada di keranjang
      _items[index].quantity++; // Tambah jumlah jika sudah ada di keranjang
    } else {
      _items.add(item); // Tambah item jika belum ada di keranjang
    }
    notifyListeners();
  }

  void decreaseQuantity(Item item) {
    // Method untuk mengurangi jumlah item
    final index = _items.indexWhere(
      (element) => element.id == item.id,
    ); // Cari index item
    if (index != -1) {
      if (_items[index].quantity > 1) {
        // Cek apakah jumlah item lebih dari 1
        _items[index].quantity--; // Kurangi jumlah jika lebih dari 1
      } else {
        _items.removeAt(index); // Hapus jika jumlahnya 1
      }
      notifyListeners();
    }
  }
}
