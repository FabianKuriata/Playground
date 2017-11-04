PImage cat;
Photo catty;
void setup(){
  size(500,500);
  cat = loadImage("kot.jpg");
  catty = new Photo("kot.jpg",500,500);
  
}
void draw(){
  //background(255);
  //image(cat, 0, 0, 500, 500);
  catty.display();
  //catty.negative();
  //catty.brightness(mouseX/2);
  catty.flashlight();
}