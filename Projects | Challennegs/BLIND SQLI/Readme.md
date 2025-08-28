refer to writeups don't use ai in the given time make the best use of it in the payload union select should not be used the level has to be made like you can complete this wusing a script(python) like that of lords of sqli TODO: do dialy commits status updates should be in detail the blockers should be mentioned properly refer as much and do your best the writeups hould be like that as a beginner could also understand

07-02-2025 trying some php scripts related to my before blind sqli challenge i slept off i didn't woke up sorry

08-02-2025 made a php script which you guys may find similer to lords of sqli code i took refernce from it then with my before php i made a new one now i have to make a sample python script to test

09-02-2025 made a python script to get the password but the thing is that http://localhost/sqli_challenge/index.php?pw=%27%20%7C%7C%20id%3D%27admin%27%20%26%26%20SUBSTR%28pw%2C%2019%2C%201%29%3D%27z%27%20--%20 for this it is giving the boolean thingy but if i type http://localhost/sqli_challenge/index.php?pw=' || id='admin' && substr(pw,1,1)='d'# i am not getting hello admin

10-02-2025 when i checked and read about why it is not coming the probable reason is that the they of database i am using does support to this so i guess using the url encoding directly is better for this i just kept another check condition the php script and the python script is done ig i have to still look in some other ways
