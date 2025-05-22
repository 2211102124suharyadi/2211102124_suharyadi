import 'dart:io'; //Menambah import io package yaitu input output
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';

//Membuat Class GalleryPage yang merupakan turunan dari StatefulWidget
class GalleryPage extends StatefulWidget {
  @override
  _GalleryPageState createState() => _GalleryPageState(); //Mengembalikan nilai _GalleryPageState
}

//Membuat Class _GalleryPageState
class _GalleryPageState extends State<GalleryPage> {
  //Membuat Class _GalleryPageState yang merupakan turunan dari State<GalleryPage>
  File? _image; //Membuat variabel _image dengan tipe data File
  final ImagePicker
  _picker = //Membuat variabel _picker dengan tipe data ImagePicker
      ImagePicker(); //Membuat variabel _picker dengan tipe data ImagePicker

  Future<void> _pickImage(ImageSource source) async {
    //Membuat fungsi _pickImage dengan parameter source
    //Membuat fungsi _pickImage dengan parameter source
    final pickedFile = await _picker.pickImage(
      //Membuat variabel pickedFile dengan tipe data File
      source: source, //Mengisi nilai source dengan parameter source
    ); //Membuat variabel pickedFile dengan tipe data File
    if (pickedFile != null) {
      //Jika pickedFile tidak sama dengan null
      setState(() {
        //Mengubah state widget
        _image = File(
          pickedFile.path,
        ); //Mengisi nilai _image dengan path dari pickedFile
      });
    }
  }

  @override
  //Membuat Widget build
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text("Gallery Picker")),
      body: Column(
        mainAxisAlignment: MainAxisAlignment.center, //Mengatur posisi widget
        children: [
          //Membuat widget children
          _image ==
                  null //Membuat kondisi jika _image sama dengan null
              ? Text("No image selected") //Membuat widget Text
              : Image.file(
                _image!,
                width: 200,
                height: 200,
              ), //Membuat widget Image
          SizedBox(height: 20), //Membuat widget SizedBox
          Row(
            //Membuat widget Row
            mainAxisAlignment:
                MainAxisAlignment.center, //Mengatur posisi widget
            children: [
              //Membuat widget children
              ElevatedButton(
                //Membuat widget ElevatedButton
                onPressed:
                    () => _pickImage(
                      ImageSource.gallery,
                    ), //Membuat fungsi onPressed
                child: Text("Pick from Gallery"), //Membuat widget Text
              ),
              SizedBox(
                width: 10,
              ), //Membuat widget SizedBox dengan ukuran width 10
              ElevatedButton(
                //Membuat widget ElevatedButton
                onPressed:
                    () => _pickImage(
                      ImageSource.camera,
                    ), //Membuat fungsi onPressed
                child: Text("Take Photo"), //Membuat widget Text
              ),
            ],
          ),
        ],
      ),
    );
  }
}
