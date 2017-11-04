import processing.video.*;

Capture video;
Cam camera;

void setup(){
  size(1280,720);
  video = new Capture(this, 1280, 720, 30);
  video.start();
  //Cam camera = new Cam(video);
}

void captureEvent(Capture video){
  video.read();
}

void draw(){
  Cam camera = new Cam(video);
  //camera.standard();
  //camera.reversed();
  //camera.split();
  camera.filtr("red");
  
  //image(video, 0 , 0, width, height);
}