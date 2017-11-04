float x;
float y;
float spacing = 50;

void setup(){
  size(640,360);
}

void draw(){
  background(0);
  x = 0;
  y = 0;
  spacing = spacing + 0.5;
  //size = random(1,100);
  stroke(255);
  strokeWeight(2);
  
  while(x < width){
    line(x, 0, x, height);
    x+=spacing;
  }
  
  while(y < height){
    line(0, y, width, y);
    y+=spacing;
  }
  
}