import 'package:flutter/material.dart'; //Menambah import material package
import 'package:camera/camera.dart'; //Menambah import camera package

//Membuat class CameraPage yang merupakan StatefulWidget
class CameraPage extends StatefulWidget {
  @override
  _CameraPageState createState() => _CameraPageState();
}

//Membuat class _CameraPageState yang merupakan State dari CameraPage
class _CameraPageState extends State<CameraPage> {
  CameraController? _controller;
  List<CameraDescription>? cameras;
  Future<void>? _initializeControllerFuture;

  @override
  void initState() {
    super.initState();
    _setupCamera();
  }

  //Membuat method _setupCamera untuk menginisialisasi kamera
  Future<void> _setupCamera() async {
    cameras = await availableCameras(); //Mengambil daftar kamera yang tersedia
    _controller = CameraController(
      cameras![0],
      ResolutionPreset.high,
    ); //Menginisialisasi kamera dengan resolusi tinggi
    _initializeControllerFuture =
        _controller!.initialize(); //Menginisialisasi controller kamera
    setState(() {}); //Mengubah state widget
  }

  @override
  //Membuat method dispose untuk membersihkan controller kamera
  void dispose() {
    _controller?.dispose(); //Membersihkan controller kamera
    super.dispose(); //Membersihkan state widget
  }

  @override
  //Membuat method build untuk membuat tampilan widget
  Widget build(BuildContext context) {
    if (_controller == null || !_controller!.value.isInitialized) {
      //Mengecek apakah controller kamera sudah diinisialisasi
      return Center(
        child: CircularProgressIndicator(),
      ); //Menampilkan loading indicator
    }
    return Scaffold(
      //Menampilkan scaffold
      appBar: AppBar(title: Text("Camera")), //Menampilkan app bar
      body: CameraPreview(_controller!), //Menampilkan preview kamera
      floatingActionButton: FloatingActionButton(
        //Menampilkan floating action button
        onPressed: () async {
          try {
            await _initializeControllerFuture; //Menunggu controller kamera diinisialisasi
            final image =
                await _controller!.takePicture(); //Mengambil foto dari kamera
            ScaffoldMessenger.of(context).showSnackBar(
              //Menampilkan snackbar
              SnackBar(
                content: Text("Photo saved to: ${image.path}"),
              ), //Menampilkan pesan snackbar
            );
          } catch (e) {
            print(e); //Menampilkan error jika terjadi kesalahan
          }
        },
        child: Icon(Icons.camera), //Menampilkan icon camera
      ),
    );
  }
}
