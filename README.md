# Smart Livebox TV

This project is a wrapper to your LiveboxTV API.
It can be usefull to plug your livebox with a google Home for example.

Orange, prevent to access to your tvBox from outside your private network.
So to control your box with google home or other service you need te set up a service to do it.

Using, Smart Livebox Tv, you don't have to expose your liveboxTv on the web. 

## Install it

Deploy it on a raspberry pi, or computer. And redirect your livebox port. 

## How to use it

### Channel

 - `/channel/name/**name**`, allow to switch to a specific named channel, *http://yourip/channel/TF1* 
 - `/channel/**channelNumber**`, allow to switch to a channel, *http://yourip/channel/1*
 - `/channel/next`, next channel
 - `/channel/previous`, previous channel
 
### TV
 
 - `/on`, turn on the box
 - `/off`, turn off the box
 
### Volume

 - `/volume/up`, set up the volume
 - `/volume/down`, set down the volume
 - `/volume/mute`, mute the volume
 
 ### Contribute
 
 Feel free, to make suggestion to improve this service.
 
