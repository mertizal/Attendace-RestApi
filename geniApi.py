import requests
from datetime import datetime

geni_discord_id=[561941184294158387,799673454944452608,502566940166848537,202732899978444800,305674590846189571,663026802511577137,526137504059883550]
discord_to_user_id = {
    561941184294158387: 1,
    799673454944452608: 3,
    502566940166848537: 4,
    526137504059883550: 5,
    663026802511577137: 6,
    202732899978444800: 7,
    305674590846189571: 8
}

# 561941184294158387 -> 1 , 799673454944452608 -> 3 , 502566940166848537 -> 4 , 526137504059883550 -> 5 , 663026802511577137 -> 6 , 202732899978444800 -> 7 , 305674590846189571 -> 8

def geniApiPostAttendace(clicked_users_id=[]):

    current_date = datetime.now()
    current_formatted_date = current_date.strftime("%Y-%m-%d")
    url = "http://127.0.0.1:1071/api/attendace"
    headers = {
    "Authorization": "Bearer gJVjKgSKzih0DiE2EcBxYvepplAo92q3zXTyif2U3d4e478f",
    "Content-Type": "application/json"}
    if clicked_users_id:
        for discord_id in geni_discord_id:
            if discord_id in clicked_users_id:
                data = {
                    "user_genis_id": discord_to_user_id.get(discord_id, "Kullanıcı ID'si bulunamadı"),
                    "date": current_formatted_date,
                    "status": "present"}
                response = requests.post(url, json=data, headers=headers)
                print(response.status_code)
                print(response.json())
            else:
                data = {
                    "user_genis_id": discord_to_user_id.get(discord_id, "Kullanıcı ID'si bulunamadı"),
                    "date": current_formatted_date,
                    "status": "absent"}
                response = requests.post(url, json=data, headers=headers)
                print(response.status_code)
                print(response.json())

       
#geniApiPostAttendace()


def geni_get_attendace_by_id(user_id,start_date,end_date):

    
    url = "http://127.0.0.1:1071/api/attendace/search"
    headers = {
    "Authorization": "Bearer gJVjKgSKzih0DiE2EcBxYvepplAo92q3zXTyif2U3d4e478f",
    "Content-Type": "application/json"}
    data = {
        "search" : {
            "value" : user_id
            
        },
        "sort" : [
            {"field" : "date", "direction" : "desc"}
        ],
        "filters": [
            {"nested": [
            {"field": "date", "operator": "<=", "value": end_date },
            {"field": "date", "operator": ">=", "value": start_date , "type": "and"}
            ]}
        ]}
    response = requests.post(url, json=data, headers=headers)
    print(response.status_code)
    print(response.json())

    return response

#geni_get_attendace_by_id("1","2024-07-26","2024-07-27")
   