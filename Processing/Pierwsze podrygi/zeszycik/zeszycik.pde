
void setup() {
  size(640, 320);
  background(100, 200, 200);
}
void draw() {
  


    // rysuje linie o danym kolorze
    //stroke(0, 0, 255); // rgb
    //line(300, 100, 400, 200); // linia(x1,y1,x2,y2)

    //rysuje prostokąt o danym kolorze 
    stroke(255);
    //fill(0, 0, 0);
    rectMode(CENTER);
    line(mouseX+1, mouseY, mouseX, mouseY+1);
    //rect(mouseX, mouseY, mouseX, mouseY);// prostokat(x1,y1,szer,wys);
  }

void mousePressed() {
  
  rect(mouseX, mouseY, 100, 100);
}