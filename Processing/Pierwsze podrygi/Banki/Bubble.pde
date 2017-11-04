class Bubble{
 float x;
 float y;
 float r;
 float speed;
 
 Bubble(){
   x = random(width);
   y = height;
   fill(0,15);
   strokeWeight(0);
   r = random(20,100);
   speed = random(1,3);
 }
 
 void display(){
   ellipse(x,y,r,r);
 }
 
 void ascend(){
   y-=speed;
   x+= random(-1,1);
 }
 
 void top(){
   if(y < -r/2){
     y = height + r/2;
   }
 }
}