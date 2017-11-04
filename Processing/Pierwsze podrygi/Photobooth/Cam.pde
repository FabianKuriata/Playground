class Cam {
  Capture video;
  
  Cam(Capture video){
    this.video = video;
  }
  
  void standard(){
    image(video, 0, 0, width, height);
  }
  
  void reversed(){
    loadPixels();
    video.loadPixels();
    for(int x = 0; x < width-1; x++){
      for(int y = 0; y < height-1; y++){
        int loc = x + (y * width);
        int loc2 = (width - x) + (y*width);
        pixels[loc2] = video.pixels[loc];
      }
    }
    updatePixels();
  }
  
  void split(){
    loadPixels();
    video.loadPixels();
    for(int x = width/2; x < width; x++){
      for(int y = 0; y < height-1; y++){
        int loc = x + (y * width);
        int loc2 = (width - x) + (y*width);
        int sp1 = loc2+width/2;
        int sp2 = sp1;
        pixels[loc2] = video.pixels[loc];
        pixels[sp1] = video.pixels[sp2];
      }
    }
    updatePixels();
  }
  
  void filtr(String name){
    
    switch(name){
      case "red":fill(255, 0, 0); image(video, 0, 0, width, height);break;
      case "green": break;
      case "blue": break;
    }
  }
}