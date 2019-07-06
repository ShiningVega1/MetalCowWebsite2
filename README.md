# Updating the MetalCow MetalCow

## Step 1: Intall virtualbox
https://www.virtualbox.org/wiki/Downloads

## Step 2: Install Vagrant
https://www.vagrantup.com/

## Step 3: Install Git and GitHub Desktop
https://desktop.github.com/

## Download the MetalCow Website
Go to: https://github.com/MetalCowRobotics/MetalCowWebsite
then choose "Clone or Download" and pick "Desktop" to clone the MetalCowWebsite with GitHub Desktop.

## Step 4: Setup a ScotchBox Image
https://box.scotch.io/docs/

You'll need to clone scotchbox down and then setup this as the Vagrantfile
```
config.vm.box = "scotch/box"
config.vm.network "private_network", ip: "192.168.33.10"
config.vm.hostname = "scotchbox"
config.vm.synced_folder "C:\\Users\\cowUser\\Documents\\GitHub\\MetalCowWebsite\\www", "/var/www/public", create: true
```
The following are the key steps....

### Configure the IP address.
In your `Vagrantfile` look for the line similar to this and make sure it matches the following
```
config.vm.network "private_network", ip: "192.168.33.10"
```

Open a Command Prompt and `cd` to the folder where you downloaded ScotchBox.  In that folder run the `vagrant up` command. *This may take a few minutes be patient, remember it is downloading, configuring, installing software, and booting a whole new computer*

Once `vagrant up` is complete you will have a server running on your computer.  You should be able to visit `192.168.33.10` in Chrome. The "Welcome to ScotchBox" default site should show.  Feel free to look at all of what is available to you on ScotchBox!

Now run `vagrant destroy` to shut it down.

### Configure the project folder
Before you can see the MetalCow website you will have to link the site on your local machine - the host - to the ScotchBox server.  To do that open your Vagrantfile again and look for the following line
```
config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=777", "fmode=666"]
```

change it to
```
config.vm.synced_folder "[PATH-TO-PROJECT-ON-YOUR-COMPUTER]/MetalCowWebsite/www", "/var/www/public", create: true
```

Go back to the folder where you installed ScotchBox and restart the server with the `vagrant up` command.

Visit `192.168.33.10` and confirm that the MetalCow Website loads.
All the pages should work, except submitting the application form, since the mailserver is not connected.

## Step 5: Install Atom.io
https://atom.io/

## Step 6: Open the MetalCowWebsite project in Atom
Open Atom.io and File>Add Project Folder>Choose the MetalCowWebsite folder and click "Open"

Make a branch for your work in GitHub Desktop
Make the changes you wanted
Submit an pull requests you want.

Do not do work on the `production` branch, this one is the one tied to the live website and only Code Leads can push to that branch.
