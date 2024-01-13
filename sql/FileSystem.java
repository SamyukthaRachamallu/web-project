package edu.umb.cs680.hw08;

import java.util.LinkedList;

//Singleton class
public class FileSystem {

    private static FileSystem theInstance;
    private LinkedList<Directory> rootDirectories;
    private FileSystem() {
        this.rootDirectories = new LinkedList<Directory>();
    }; 

    public static FileSystem getFileSystem() {
        if (theInstance == null) {
            theInstance = new FileSystem();
        }
        return theInstance;
    }

    public LinkedList<Directory> getRootDirs() {
        return this.rootDirectories;
    }

    public void appendRootDirectory(Directory dir) {
        this.rootDirectories.add(dir);
        dir.parent = null;
    }
    public static void main(String args[]) {
    }
}