import 'package:flutter/material.dart'; //Mengimport package material.dart
import 'camera_page.dart'; //Mengimport camera_page.dart
import 'gallery_page.dart'; //Mengimport gallery_page.dart

//Membuat fungsi main yang akan dijalankan pertama kali
void main() {
  runApp(MyApp()); //Menjalankan class MyApp
}

//Membuat class MyApp yang merupakan turunan dari StatelessWidget
class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      //Membuat widget MaterialApp
      debugShowCheckedModeBanner: false,
      home: HomePage(), //Mengisi nilai home dengan Class HomePage
    ); //Mengembalikan nilai MaterialApp
  }
}

//Membuat class HomePage yang merupakan turunan dari StatelessWidget
class HomePage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    //Membuat widget build
    return Scaffold(
      appBar: AppBar(title: Text("Camera & Gallery App")), //Membuat AppBar
      body: Center(
        //Mengatur posisi widget ke tengah
        child: Column(
          //Membuat widget Column
          mainAxisAlignment:
              MainAxisAlignment.center, //Mengatur posisi widget ke tengah
          children: [
            //Membuat widget children berupa array
            ElevatedButton(
              //Membuat widget ElevatedButton untuk membuka kamera
              onPressed: () {
                //Membuat fungsi onPressed untuk membuka kamera
                Navigator.push(
                  //Mengarahkan ke halaman CameraPage
                  context, //Mengarahkan ke halaman CameraPage
                  MaterialPageRoute(
                    builder: (context) => CameraPage(),
                  ), //Mengarahkan ke halaman CameraPage
                );
              },
              child: Text("Open Camera"), //Membuat widget Text "Open Camera"
            ),
            SizedBox(height: 20), //Membuat widget SizedBox untuk memberi jarak
            ElevatedButton(
              //Membuat widget ElevatedButton untuk membuka gallery
              onPressed: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => GalleryPage(),
                  ), //Mengarahkan ke halaman GalleryPage
                );
              },
              child: Text("Open Gallery"), //Membuat widget Text "Open Gallery"
            ),
          ],
        ),
      ),
    );
  }
}
