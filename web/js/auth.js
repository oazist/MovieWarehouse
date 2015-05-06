var apiKey = 'AIzaSyBj8gccpnR67b5Bh8BY4t30f_5PqL3jO7s';
var OAUTH2_CLIENT_ID = '806832809053-tait9cern3ahdk8669ve1l7eab2ek301.apps.googleusercontent.com';
var OAUTH2_SCOPES = 'https://www.googleapis.com/auth/youtube';

// Upon loading, the Google APIs JS client automatically invokes this callback.
googleApiClientReady = function () {
    gapi.client.setApiKey(apiKey);
    gapi.auth.init(function () {
        window.setTimeout(checkAuth, 1);
    });
}

// Attempt the immediate OAuth 2.0 client flow as soon as the page loads.
// If the currently logged-in Google Account has previously authorized
// the client specified as the OAUTH2_CLIENT_ID, then the authorization
// succeeds with no user intervention. Otherwise, it fails and the
// user interface that prompts for authorization needs to display.
function checkAuth() {
    gapi.auth.authorize({
        client_id: OAUTH2_CLIENT_ID,
        scope: OAUTH2_SCOPES,
        immediate: true
    }, handleAuthResult);
}

// Handle the result of a gapi.auth.authorize() call.
function handleAuthResult(authResult) {
    if (authResult && !authResult.error) {
        // Authorization was successful. Hide authorization prompts and show
        // content that should be visible after authorization succeeds.
        console.log("success");
        $('.pre-auth').hide();
        $('.post-auth').show();
        loadAPIClientInterfaces();
    } else {
        console.log("fail");
        // Make the #login-link clickable. Attempt a non-immediate OAuth 2.0
        // client flow. The current function is called when that flow completes.
        $('#login-link').click(function () {
            gapi.auth.authorize({
                client_id: OAUTH2_CLIENT_ID,
                scope: OAUTH2_SCOPES,
                immediate: false
            }, handleAuthResult);
        });
    }
}

// Load the client interfaces for the YouTube Analytics and Data APIs, which
// are required to use the Google APIs JS client. More info is available at
// http://code.google.com/p/google-api-javascript-client/wiki/GettingStarted#Loading_the_Client
function loadAPIClientInterfaces() {
    gapi.client.load('youtube', 'v3', function () {
        var q = document.getElementById("title").innerHTML + " trailer";
        console.log(q);
        var request = gapi.client.youtube.search.list({
            q: q,
            part: 'snippet',
            maxResults: 1
        });

        request.execute(function (response) {
            var videoId = response.result.items[0].id.videoId;
            var videoTitle = response.result.items[0].snippet.title;
            
            ClientAPIHandler(videoId,videoTitle);      
        });
    });
}