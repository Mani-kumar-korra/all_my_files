require( // The "paths" maps module names to actual places to fetch the file.
    // I made modules with simple names (jquery, sammy) that will do the hard work.
    { paths: { jquery: "require_jquery"
            , sammy : "require_sammy"
        }
    }

    // Next is the root module to run, which depends on everything else.
    , [ "triggerUserSession" ]

    // Finally, start my app in whatever way it uses.
    , function(triggerUserSession) { triggerUserSession.start(); }
);