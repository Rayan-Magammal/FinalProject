import 'package:flutter/material.dart';
import '../../models/user.dart';
import '../shared/mainmenu.dart';


class BookingScreen extends StatefulWidget {
  final User user;
  const BookingScreen({super.key, required this.user});
  @override
  State<BookingScreen> createState() => _BookingScreenState();
}

class _BookingScreenState extends State<BookingScreen> {
  @override
  Widget build(BuildContext context) {
    return WillPopScope(
      onWillPop: () async => false,
      child: Scaffold(
          appBar: AppBar(title: const Text("Profile")),
          body: const Center(child: Text("Profile")),
          drawer: MainMenuWidget(user: widget.user,)),
    );
  }
}