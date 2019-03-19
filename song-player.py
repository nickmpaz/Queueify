import sys
import spotipy
import spotipy.util as util
import mysql.connector
from mysql.connector import Error
from mysql.connector import errorcode
import time

userkey = "SPOTIFY_USERNAME"
clientkey = "SPOTIFY_CLIENT"
secretkey = "SPOTIFY_SECRET"
username = ""
client_id = ""
client_secret = ""

#get info from .env file
with open('.env') as f:
    for line in f:
        if userkey in line:
            username = line.replace('SPOTIFY_USERNAME=','').strip()
        if clientkey in line:
            client_id = line.replace('SPOTIFY_CLIENT=','').strip()
        if secretkey in line:
            client_secret = line.replace('SPOTIFY_SECRET=','').strip()


connection_config_dict = {
    'user': 'homestead',
    'password': 'secret',
    'host': '127.0.0.1',
    'database': 'homestead',
    'raise_on_warnings': True,
    #'use_pure': False,
    'autocommit': True,
    'pool_size': 5
}

scope = 'user-library-read user-read-playback-state user-modify-playback-state'

try:
    #connect to mysql database
    connection = mysql.connector.connect(**connection_config_dict)
    sql_select_Query = "select * from songs"
    sql_delete_Query = "DELETE FROM songs WHERE position = 1"
    sql_update_Query = "UPDATE songs SET position = %s WHERE position = %s"
    cursor = connection.cursor()

    #authenticate user for spotify
    token = util.prompt_for_user_token(
        username,
        scope,
        client_id,
        client_secret,
        redirect_uri='http://localhost/'
    )
    sp = spotipy.Spotify(auth=token)


    currentURI = ""

    while True:
            
        #get songs in database
        cursor.execute(sql_select_Query)
        records = cursor.fetchall()

        #if theres a song in the queue        
        if len(records) > 0:
            #play it 
            currentURI = records[0][4]
            
            try:
                sp.start_playback(uris=[currentURI])
                print("started new song.")
                #delete first row and decrement the positions of the rest
                cursor.execute(sql_delete_Query)
                for x in range (2, len(records) + 1):
                    cursor.execute(sql_update_Query, (x-1, x))

                #chill for 5 seconds
                time.sleep(5)
            except:
                print("there is no active device.")
        else:
            print("there are no songs in the queue.")

        try:
            #while sp.currently_playing()['item']['uri'] == currentURI and sp.currently_playing()['progress_ms'] < sp.currently_playing()['item']['duration_ms']:
            while sp.currently_playing()['is_playing']:
                time.sleep(3)
        except:
            print("spotify is not currently playing anything.")
        
        time.sleep(3)

    cursor.close()
except Error as e:
    print("Error while connecting to MySQL", e)
finally:
    if (connection.is_connected()):
        connection.close()
