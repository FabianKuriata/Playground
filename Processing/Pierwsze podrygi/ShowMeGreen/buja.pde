import processing.sound.*;

import processing.video.*;
int sum;
int loop = 0;
Capture video;
PImage shrek;
SoundFile shout;
int duration = 0;

void setup(){
  size(1280,720);
  
  sum = 0;
  //printArray(Capture.list());
  shrek = loadImage("shrek.png");
  video = new Capture(this, 1280,720,30); 
  shout = new SoundFile(this, "kill.mp3");
  video.start();
}

void captureEvent(Capture video){
  video.read();
  
}

void draw(){
  
  sum = 0;
  duration = 0;
  loadPixels();
  video.loadPixels();
  for(int x = 0; x < width-1; x++){
    for(int y = 0; y < height-1; y++){
      int loc = x + y *width;
      int loc2 = width-x + y*width; // odbicie lustrzane
      int a = int(brightness(video.pixels[loc]));
      int c = int(brightness(video.pixels[loc+1]));
      int diff = c - a;
      int r = int(red(video.pixels[loc]));
      int g = int(green(video.pixels[loc]));
      int b = int(blue(video.pixels[loc]));
      
      if(g > 100 && r < 160 && b < 20){
        pixels[loc2] = color(0, 0, 0);
        r = 0;
        g = 0;
        b = 0;
      }
      else
        pixels[loc2] = color(r,g,b);
      //if( diff < 0)
      //  diff = diff * -1;
      if(r == 0 && g == 0 && b == 0){
        sum++;
      }
    }
  }
  
  updatePixels();
  loop++;
  if(sum > 50000 && loop > 30){
    image(shrek, 0, 0, width,height);
    duration++;
    
  }
  if(duration > 0)
      shout.play();
      System.out.println(duration);
  //image(video,0,0,width,height);
  
}