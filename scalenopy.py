#!/usr/bin/python
try:
    from Tkinter import *
except ImportError:
    from tkinter import *
#import RPi.GPIO as GPIO
import time

global t
master = Tk()
master.title("Dr. Parvo's Marvelous Growbrain")

screen_width = master.winfo_screenwidth()
screen_height = master.winfo_screenheight()
slider_font = 18
slider_width = 80
slider_color = "SteelBlue1"
slider_trough_color = "steelblue"
slider_text_color = "black"
slider_border = 5
slider_length = 120
slider_relief = RIDGE
button_width = 39
button_height =8
button_border = 3
button_font = '-weight bold'
welcome_height = 6
welcome_width = 136
welcome_font = "57"
welcome_background = "Steelblue3"
welcome_border = 6
welcome_relief = RAISED

#master.attributes("-fullscreen", True)
#master.geometry("1366x768")
time_to_exit = False
loop_is_working = False
print(screen_width)
print(screen_height)

def onoffcycle():
    #global t
    #GPIO.setwarnings(False)
    #GPIO.setmode(GPIO.BCM)
    #GPIO.setup(18, GPIO.OUT)
    #GPIO.output(18, GPIO.LOW)
    y = float(off.get())
    x = float(on.get())
    #GPIO.output(18, True)
    print((("Water ON") + str(x)))
    t.get()
    time.sleep(x)
    #GPIO.output(18, False)
    print((("Off") + str(y)))
    time.sleep(y)


def start():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 10 seconds...")
    t.set("Prepare to Water in 10 seconds...")
    master.after(1000, ninesec)

def ninesec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 9 seconds...")
    t.set("Prepare to Water in 9 seconds...")
    master.after(1000, eightsec)

def eightsec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 8 seconds...")
    t.set("Prepare to Water in 8 seconds...")
    master.after(1000, sevensec)

def sevensec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 7 seconds...")
    t.set("Prepare to Water in 7 seconds...")
    master.after(1000, sixsec)

def sixsec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 6 seconds...")
    t.set("Prepare to Water in 6 seconds...")
    master.after(1000, fivesec)

def fivesec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 5 seconds...")
    t.set("Prepare to Water in 5 seconds...")
    master.after(1000, foursec)

def foursec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 4 seconds...")
    t.set("Prepare to Water in 4 seconds...")
    master.after(1000, threesec)

def threesec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 3 seconds...")
    t.set("Prepare to Water in 3 seconds...")
    master.after(1000, twosec)

def twosec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 2 seconds...")
    t.set("Prepare to Water in 2 seconds...")
    master.after(1000, onesec)

def onesec():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Prepare to Water in 1 second...")
    t.set("Prepare to Water in 1 second...")
    master.after(1000, nowwatering)

def nowwatering():
    global loop_is_working
    #global t
    loop_is_working = True
    print("Now Watering")
    t.set("Now Watering // Dr. Parvo Loves You!!!")
    master.after(1000, loop)


def loop():
    z = float(cycle.get())
    global loop_is_working
    global time_to_exit
    #global t
    #t.set("Now Watering...")
    if z > 0 and not time_to_exit and loop_is_working:
        onoffcycle()
        z = z - 1
        cycle.set(z)
        print((("Now Watering: Cycles remaining: ") + str(z)))
        t.set("Now Watering // Dr. Parvo Loves You!!!")
        master.after(1000, loop)
    else:
        reset()


def reset():
    global loop_is_working
    #GPIO.cleanup()
    on.set(0)
    off.set(0)
    cycle.set(0)
    t.set("Welcome! Drag the sliders to set values. Tap to the left or right"
    "of the sliders to fine tune the values.")
    loop_is_working = False

t = StringVar()
t.set("Welcome! Drag the sliders to set values. Tap to the left or right of "
"the sliders to fine tune the values.")

welcome = Label(master, bg=welcome_background, bd=welcome_border,
relief=welcome_relief,
width=welcome_width, height=welcome_height, font=welcome_font, textvariable=t)
welcome.grid(column=1, row=1, columnspan=3)

on = Scale(master, label="Set # Seconds Water ON:", font=slider_font,
from_=0, to=120, orient=HORIZONTAL, length=screen_width, width=slider_width,
troughcolor=slider_trough_color, bg=slider_color, fg=slider_text_color,
bd=slider_border, sliderlength=slider_length, sliderrelief=slider_relief)
on.grid(column=1, row=2, columnspan=3)

off = Scale(master, label="Set # Seconds Water OFF:", font=slider_font,
from_=0, to=30, orient=HORIZONTAL, length=screen_width, width=slider_width,
troughcolor=slider_trough_color, bg=slider_color, fg=slider_text_color,
bd=slider_border, sliderlength=slider_length, sliderrelief=slider_relief)
off.grid(column=1, row=3, columnspan=3)

cycle = Scale(master, label="Set # of Plants to Water:", font=slider_font,
from_=0, to=200, orient=HORIZONTAL, length=screen_width, width=slider_width,
troughcolor=slider_trough_color, bg=slider_color, fg=slider_text_color,
bd=slider_border, sliderlength=slider_length, sliderrelief=slider_relief)
cycle.grid(column=1, row=4, columnspan=3)

go = Button(master, text="START", command=start, bg="green3",
width=button_width, height=button_height, bd=button_border, font=button_font)
go.grid(column=1, row=5)

adios = Button(master, text="EXIT", command=exit, bg="red3",
width=button_width, height=button_height, bd=button_border, font=button_font)
adios.grid(column=3, row=5)

resetb = Button(master, text="RESET", command=reset, bg="yellow3",
width=button_width, height=button_height, bd=button_border, font=button_font)
resetb.grid(column=2, row=5)

mainloop()
