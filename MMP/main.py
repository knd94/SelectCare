from machine import Pin, PWM
from time import sleep
import network
import urequests as requests
import json

ssid = 'BT-G3A2N6'
password = '3pyNKt9bEcgFiR'

#ssid = 'AndroidAP'
#password = 'mithrandir2'

insert_state = 'https://mi-linux.wlv.ac.uk/~2229668/select_care/website_files/insert_state.php'
check_state = 'https://mi-linux.wlv.ac.uk/~2229668/select_care/website_files/check_state.php'

#insert_state = 'https://mi-linux.wlv.ac.uk/~1808558/collaborative_project/website_files/insert_state.php'
#check_state = 'https://mi-linux.wlv.ac.uk/~1808558/collaborative_project/website_files/check_state.php'

#insert_state = 'https://192.168.1.81/insert_state.php'
#check_state = 'https://192.168.1.81/check_state.php'

light_state = {'colour' : 'green', 'state' : 'off'} 

def connect():
    wlan = network.WLAN(network.STA_IF)
    wlan.active(True)
    wlan.connect(ssid, password)
    while wlan.isconnected() == False:
        print('Waiting for connection...')
        sleep(1)
    ip = wlan.ifconfig()[0]
    print(f'Connected on {ip}')


red = PWM(Pin(16))
green = PWM(Pin(17))
blue = PWM(Pin(18))

button = Pin(15, Pin.IN, Pin.PULL_UP)

red.freq(1000)
green.freq(1000)
blue.freq(1000)

def colour(r, g, b):
    red.duty_u16(r)
    green.duty_u16(g)
    blue.duty_u16(b)
    
def get_state():
    lightGet = requests.get(check_state)
    status = lightGet.status_code
    jsonResponse = lightGet.json()
    state = jsonResponse["state"]
    print(state)
    return state

def send_state(light_state):
    lightJSON = json.dumps(light_state)
    lightSend = requests.post(insert_state, data = lightJSON, headers = {"Content-Type" : "application/json"})
    status = lightSend.status_code
    #print("Python JSON = ", lightJSON)
    #print(status)
    #print(lightSend.text)
    return lightSend

def reset_state(light_state):
    light_state['colour'] = 'green';
    light_state['state'] = 'off';

def main():
    connect()
    colour(65535, 0, 0)
    print("Not Pressed Light State: ", light_state)
    while True:
   
        if button.value() == 0:
            print("Button Pressed")
            colour(0, 65535, 0)
            light_state['colour'] = 'red';
            light_state['state'] = 'on';
            print("Pressed Button Light State: ", light_state)
            send_state(light_state)
            while light_state['state'] == 'on':
                state = get_state()
                #print(state)
                if state != 'on':
                    reset_state(light_state)
                    print("Not Pressed Light State: ", light_state)
                
        else:
            colour(65535, 0, 0)

if __name__=='__main__':
    main()
