from importlib.resources import path
import json
import requests
from bs4 import BeautifulSoup
import time
import os
from os import path, system
from datetime import datetime

def header():
    print("""
    
████████╗██████╗░███████╗███╗░░██╗██████╗░██╗░░░██╗░█████╗░██╗░░░░░
╚══██╔══╝██╔══██╗██╔════╝████╗░██║██╔══██╗╚██╗░██╔╝██╔══██╗██║░░░░░
░░░██║░░░██████╔╝█████╗░░██╔██╗██║██║░░██║░╚████╔╝░██║░░██║██║░░░░░
░░░██║░░░██╔══██╗██╔══╝░░██║╚████║██║░░██║░░╚██╔╝░░██║░░██║██║░░░░░
░░░██║░░░██║░░██║███████╗██║░╚███║██████╔╝░░░██║░░░╚█████╔╝███████╗
░░░╚═╝░░░╚═╝░░╚═╝╚══════╝╚═╝░░╚══╝╚═════╝░░░░╚═╝░░░░╚════╝░╚══════╝
    
    """)
    print("Toplu Ürün Fiyat Takip Botu by ArdA")
    print("-------------------------------------------------------------------------------")
    print("Program yeniden çalışmaz ise data.json dosyasını silin.")
    print("-------------------------------------------------------------------------------")
    print("İletişim: https://aarda.bio.link/")
    print("-------------------------------------------------------------------------------")

headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36"
}

links = []
link = open("links.txt").read().splitlines()

for x in link:
    links.append(x)

if path.exists("./data.json"):
    print("Programda verileriniz bulunuyor. Bilgi bütünlüğü kontrolü sağlandıktan sonra program çalışacak.")

    f = open('data.json')
    first = json.load(f)

    if first['len'] == len(links):
        print("Verilerde bir soruna rastlanmadı.")
        pass

    else:
        print("Link dosyası bir önceki haliyle aynı olmadığı için program düzgün çalışmayacak.")
        print("Dizinde bulunan data.json dosyasını silip programı yeniden çalıştırın.")
        quit()


else:
    print("Programı ilk kez kullanıyorsunuz. Lütfen bekleyin.")
    first = {}
    for x in range(len(links)):
        page = requests.get(url=links[x], headers=headers)
        htmlPage = BeautifulSoup(page.content, 'html.parser')
        productTitle = htmlPage.find("h1", class_="pr-new-br").getText()
        price = htmlPage.find("span", class_="prc-slg").getText()
        convertedPrice = float(price.replace(",", ".").replace(" TL", ""))

        first[x] = {'link': links[x], 'productTitle': productTitle,
                    'convertedPrice': convertedPrice}

    first['len'] = len(links)
    with open('data.json', 'w') as f:
        json.dump(first, f)

    print("Verileriniz data.json dosyasına kaydedildi.")


def sayac(t):
    while t > 0:
        t = t-1
        time.sleep(1)
        os.system("cls")
        print("{} saniye sonra yeniden deneyecek.".format(t))


def sendMessage(message):
    bot_token = 'sizin-bot-tokeniniz'
    bot_chatID = 'sizin-chat-id' #başında - olacak |-2324242121 gibi
    send_text = 'https://api.telegram.org/bot' + bot_token + '/sendMessage?chat_id=' + bot_chatID + '&parse_mode=Markdown&text=' + message
    response = requests.get(send_text)


def check(x):
    page = requests.get(url=links[x], headers=headers)
    htmlPage = BeautifulSoup(page.content, 'html.parser')
    productTitle = htmlPage.find("h1", class_="pr-new-br").getText()
    price = htmlPage.find("span", class_="prc-slg").getText()
    convertedPrice = float(price.replace(",", ".").replace(" TL", ""))

    f = open('./data.json')
    second = json.load(f)
    valuess = list(second.values())

    if convertedPrice < valuess[x]["convertedPrice"]:
        message = "💯 --- *FİYAT DÜŞTÜ* --- 💯\n{}\n🎉 Güncel Fiyat: {}\n⏰ İlk Fiyat: {}\n{}".format(productTitle,convertedPrice,valuess[x]["convertedPrice"],links[x])
        sendMessage(message)
        print("Telegram mesajı gönderildi. Güncel Fiyat: " + str(convertedPrice) + "\n")

    else:
        now = datetime.now()
        dt_string = now.strftime("%d/%m/%Y %H:%M:%S")
        print(valuess[x]['productTitle'] +
              " - Ürün fiyatı değişmedi! Kontrol Tarihi: " + dt_string + "\n")


print("Kontrol başlıyor.")
time.sleep(3)
while True:
    os.system('cls')
    header()
    for x in range(len(links)):
        check(x)
        time.sleep(1)
    sayac(3)
