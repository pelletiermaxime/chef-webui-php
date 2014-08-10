#/bin/bash

for i in {1..60}
do
    username=`curl "https://gitlab.libeo.com/api/v3/users/$i?private_token=3rsb7Y6RdU16QHdEhZBg" | jq -r '.username'`
    curl "https://gitlab.libeo.com/api/v3/users/$i/keys?private_token=3rsb7Y6RdU16QHdEhZBg" > "$username.keys"
done
