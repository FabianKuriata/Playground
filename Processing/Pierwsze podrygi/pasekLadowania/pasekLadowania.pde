float x = 0;
void setup(){
  size(640,360);
}

void draw(){
  rectMode(CENTER);
  fill(255);
  rect(width/2,height/2,500,20);
  fill(255,0,0);
  
  rectMode(CORNER);
  rect(70,170,x,20);
  
   if(x < 500){  
     x+=1;
   }
  
}