#!/usr/bin/python

try:
    from Tkinter import *
except ImportError:
    from tkinter import *
#import RPi.GPIO as GPIO

#GPIO.setwarnings(False)
#GPIO.setmode(GPIO.BCM)
#GPIO.setup(18, GPIO.OUT)
#GPIO.output(18, GPIO.LOW)

import time

class Application(Frame):

    def co2on(self):
        print ("CO2 is now ON")
        #GPIO.output(18, True)
        self.on_button["bg"] = "green2"
        self.off_button["bg"] = "grey"
        self.fifteenminbutton["bg"] = "grey"

    def co2off(self):
        print ("CO2 is now OFF")
        #GPIO.output(18, False)
        self.off_button["bg"] = "green2"
        self.on_button["bg"] = "grey"
        self.fifteenminbutton["bg"] = "grey"

    def fifteenon(self):
        #GPIO.output(18, True)
        self.fifteenminbutton["bg"] = "green2"
        self.off_button["bg"] = "grey"
        self.on_button["bg"] = "grey"
        z = 15
        if z > 0:
            #GPIO.output(18, True)
            print ("CO2 is now ON for 15 min/hour")
            z = z - 1
            root.after(60000)
        else:
            co2off(self)

    def fortyfiveoff(self):
        print ("CO2 is now OFF for 45 min")
        #GPIO.output(18, False)
        self.fifteenminbutton["bg"] = "grey"
        self.off_button["bg"] = "grey"
        self.on_button["bg"] = "grey"
        root.after(2700000, fifteenon)


    def createWidgets(self):
        self.QUIT = Button(self)
        self.QUIT["text"] = "QUIT"
        self.QUIT["fg"] = "red"
        self.QUIT["command"] = self.quit

        self.on_button = Button(self)
        self.on_button["text"] = ("CO2 ON")
        self.on_button["command"] = self.co2on

        self.fifteenminbutton = Button(self)
        self.fifteenminbutton["text"] = ("15 min/hr")
        self.fifteenminbutton["command"] = self.fifteenon

        self.off_button = Button(self)
        self.off_button["text"] = ("CO2 OFF")
        self.off_button["command"] = self.co2off

        self.on_button.pack({"side": "left"})
        self.off_button.pack({"side": "left"})
        self.QUIT.pack({"side": "right"})
        self.fifteenminbutton.pack({"side": "right"})


    def __init__(self, master=None):
        Frame.__init__(self, master)
        root.title("CO2 Controller")
        self.pack()
        self.createWidgets()

root = Tk()
app = Application(master=root)
app.mainloop()
root.destroy()