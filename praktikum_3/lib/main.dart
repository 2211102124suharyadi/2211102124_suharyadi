import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    final List<String> entries = <String>['A', 'B', 'C'];
    final List<int> colorCodes = <int>[600, 500, 100];

    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(title: const Text('ListView.builder Example')),
        body: Padding(
          padding: const EdgeInsets.all(10.0),
          child: Stack(
            children: <Widget>[
              Container(width: 100, height: 100, color: Colors.red),
              Container(width: 90, height: 90, color: Colors.green),
              Container(width: 80, height: 80, color: Colors.blue),
            ],
          ),
        ),
      ),
    );
  }
}
