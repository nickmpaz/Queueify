# Queueify

Queueify is an application that allows other users on your local network to queue songs on 
your Spotify player. Play music from any Spotify device, and your friends will be able to control
what song is on next. Queueify was developed primarily with php via the Laravel framework,
and some python. It was also built for Vagrant to make hosting the application a simple process.
Just download the code, configure, and build.

## Requirements

Using Queueify requires two things:

    1)  A working Vagrant installation (https://www.vagrantup.com/downloads.html)
    2)  Premium Spotify & Spotify client credentials

Spotify client credentials can be obtained for free at(https://developer.spotify.com/dashboard/). 
Dont worry, it'll only take a minute.

Log in to your Spotify premium account and create an app. When prompted for a "Redirect URI", enter
    
    http://localhost/
    
## Download and Navigate to the New Directory

    $ git clone https://github.com/nickmpaz/queueify.git
    $ cd queueify

## Configuration

Create your .env file. An example is provided for you.

    $ mv .env.example .env

Edit the .env file with any text editor. Fill in these fields:

    SPOTIFY_USERNAME=your_username_here
    SPOTIFY_CLIENT=your_client_id_here               
    SPOTIFY_SECRET=your_client_secret_here

The CLIENT and SECRET values can be found at (https://developer.spotify.com/dashboard/).

Note: You must create the app specified in the "Requirements" section.

## Build the VM, and Run the Application

    $ vagrant up       
    $ vagrant ssh
    $ cd /vagrant && python song-player.py

The first command will take a couple minutes.

When you run the third command, you will be prompted to log in to your spotify account.
This will only happen the first time. It will look like:

    User authentication requires interaction with your
    web browser. Once you enter your credentials and
    give authorization, you will be redirected to
    a url.  Paste that url you were directed to to
    complete the authorization.

Just navigate to the URL you are given with any web browser. Log in, and you will be 
redirected to another URL. Paste that URL in the terminal and press enter.

## Usage

After starting the script you will likely see messages like

    there is no active device.
    spotify is not currently playing anything.

Just start playing some music from any Spotify app. You will then see

    there are no songs in the queue.

This means you're ready add some songs with Queueify! On your host machine you can access web app at

    localhost:8080

Others on your local network can access the app at

    your_host_machine_ip:8080

Queue songs with Queueify's simple interace. When you are done, you can shutdown
the virtual machine after logging out.

    $ exit
    $ vagrant destroy


    

