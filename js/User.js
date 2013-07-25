function User (userID,map,position) {
    this.userID = userID;
    this.map = map;
    this.position = {latitude:position.kb,longitude:position.jb};
    this.marker = new google.maps.Marker({
                        position: position,
                        map: map,
			icon: iconBase
                    });
}
 
User.prototype.getPosition = function() {
    return this.position;
};

User.prototype.removeMarker = function() {
    return this.marker.setMap(null);
};

User.prototype.getUserID = function(){
        return this.userID;
}

User.prototype.getMarker = function(){
    
    return this.marker;
}