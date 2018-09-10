# Maven

I host a few of my mods, as well as some others', on a personal maven server. You can browse that server [here](http://maven.tterrag.com)!

## How do I use maven?

If you are making a mod and would like to use one of the things in my maven, it is quite easy to do so.

First, you will need to add my maven repository to the ones that gradle searches in. In your build.gradle, just after the `minecraft` block you should have, add this:
```
repositories {
  maven { // ttCore
    name 'tterrag Repo'
    url "http://maven.tterrag.com/"
  }
}
```

If your build.gradle already has the `dependencies` section, just add the `maven` section to the existing block.

Next, you need to specify what mod to download from the maven. We do this in the `dependencies` block:

```
dependencies {
  compile "tterrag.core:ttCore:MC1.7.10-0.1.0-61:deobf"
}
```

This string is different for different projects, this one is for ttCore. The first part (parts are separated by colons) is the package, aka all the folders before the main one. In this instance, it's `tterrag.core`. Next you add the artifact ID, or the mod name, in this case 'ttCore'. Next, you add the version, this is the folder inside the mod name folder. Finally you can add an identifier, for instance `:deobf` for a deobfuscated jar, or `:api` for the API jar.

Add this block directly after your `repositories` block.
