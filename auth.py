import sys
import spotipy
import spotipy.util as util

scope = 'user-library-read user-modify-playback-state'

#if len(sys.argv) > 1:
#    username = sys.argv[1]
#else:
#    print "Usage: %s username" % (sys.argv[0],)
#    sys.exit()

username = "nicholasmpaz"
token = util.prompt_for_user_token(
    username,
    scope,
    client_id='99cbf2177bb04f76b71b7de6f87fbdc6',
    client_secret='1c4da42567b44d51892506f5a469cac6',
    redirect_uri='http://localhost/'
)


if token:

    while True:
        sp = spotipy.Spotify(auth=token)
        #results = sp.current_user_saved_tracks()
        sp.start_playback(device_id=None, context_uri=None, uris=None, offset=None)
        #for item in results['items']:
         #   track = item['track']
          #  print( track['name'] + ' - ' + track['artists'][0]['name'])
else:
    print ("Can't get token for", username)
