class Photo{
  PImage photo;
  float w;
  float h;
  
  Photo(String path, float w, float h){
    photo = loadImage(path);
    this.w = w;
    this.h = h;
  }
  
  void display(){
    image(photo, 0, 0, w,h);
  }
  void negative(){
    loadPixels();
    photo.loadPixels();
    for(int x = 0; x < w; x++){
      for(int y = 0; y < h; y++){
        int loc = int(x+y*w);
        float r = red(photo.pixels[loc]);
        float g = green(photo.pixels[loc]);
        float b = blue(photo.pixels[loc]);
        r = 255 - r;
        g = 255 - g;
        b = 255 - b;
        pixels[loc] = color(r,g,b);
      }
    }
    updatePixels();
  }
  void brightness(float brightness){
    loadPixels();
    photo.loadPixels();
    for(int x = 0; x < w; x++){
      for(int y = 0; y < h; y++){
        int loc = int(x+y*w);
        float r = red(photo.pixels[loc]);
        float g = green(photo.pixels[loc]);
        float b = blue(photo.pixels[loc]);
        
        r = r + brightness;
        g = g + brightness;
        b = b + brightness;
        
        pixels[loc] = color(r,g,b);
      }
    }
    updatePixels();
  }
  
  void flashlight(){
     loadPixels();
    photo.loadPixels();
    for(int x = 0; x < w; x++){
      for(int y = 0; y < h; y++){
        int loc = int(x+y*w);
        float r = red(photo.pixels[loc]);
        float g = green(photo.pixels[loc]);
        float b = blue(photo.pixels[loc]);
        float d = dist(mouseX, mouseY, x, y);
        float factor = map(d, 550, 100, 2, 0);
        
        pixels[loc] = color(r*factor,g*factor,b*factor);
      }
    }
    updatePixels();
  }
}