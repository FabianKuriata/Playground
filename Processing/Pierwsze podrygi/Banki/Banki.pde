Bubble[] b = new Bubble[50];

void setup(){
  size(640,640);

  for(int i = 0; i< b.length; i++){
    b[i] = new Bubble();
  }
}

void draw(){
  background(255);
  
  for(int i = 0; i < b.length; i++){
    b[i].display();
    b[i].ascend();
    b[i].top();
  }
}