#!/usr/bin/python
from tkinter import *
import RPi.GPIO as GPIO
import time


master = Tk()
master.title("Dr. Parvo's Marvelous Growbrain")
master.attributes("-fullscreen", True)
master.geometry("800x480")
time_to_exit = False
loop_is_working = False


def onoffcycle():
    global t
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(18, GPIO.OUT)
    GPIO.output(18, GPIO.LOW)
    y = float(off.get())
    x = float(on.get())
    GPIO.output(18, True)
    print((("On") + str(x)))
    t.set("Water ON")
    t.get()
    time.sleep(x)
    GPIO.output(18, False)
    print((("Off") + str(y)))
    t.set("Water OFF")
    time.sleep(y)


def start():
    global loop_is_working
    global t
    loop_is_working = True
    print("Prepare to water in 10 seconds...")
    t.set("Prepare to water in 10 seconds...")
    master.after(10000, loop)


def loop():
    z = float(cycle.get())
    global loop_is_working
    global time_to_exit
    global t
    t.set("Now Watering...")
    if z > 0 and not time_to_exit and loop_is_working:
        onoffcycle()
        z = z - 1
        cycle.set(z)
        print((("Cycles remaining: ") + str(z)))
        master.after(0, loop)
    else:
        reset()


def reset():
    global loop_is_working
    GPIO.cleanup()
    on.set(0)
    off.set(0)
    cycle.set(0)
    t.set("Welcome! Drag the sliders to set values. Tap to the left or right of"
    "the sliders to fine tune the values.")
    loop_is_working = False

t = StringVar()
t.set("Welcome! Drag the sliders to set values. Tap to the left or right of"
"the sliders to fine tune the values.")

welcome = Label(master, bg="Steelblue3", bd=6, relief=RAISED, width=98,
                height=2, textvariable=t)
welcome.grid(column=1, row=1, columnspan=3)


on = Scale(master, label="Set # Seconds Water ON:", from_=0, to=120,
orient=HORIZONTAL, length=785, width=55, troughcolor="steelblue",
bg="SteelBlue1", fg="black", bd=6, sliderlength=120, sliderrelief=RIDGE)
on.grid(column=1, row=2, columnspan=3)

off = Scale(master, label="Set # Seconds Water OFF:", from_=0, to=30,
orient=HORIZONTAL, length=785, width=55, troughcolor="steelblue",
bg="SteelBlue1", fg="black", bd=6, sliderlength=120, sliderrelief=RIDGE)
off.grid(column=1, row=3, columnspan=3)

cycle = Scale(master, label="Set # of Plants to Water:", from_=0, to=200,
orient=HORIZONTAL, length=785, width=55, troughcolor="steelblue",
bg="SteelBlue1", fg="black", bd=6, sliderlength=120, sliderrelief=RIDGE)
cycle.grid(column=1, row=4, columnspan=3)

go = Button(master, text="START", command=start, bg="green3", width=21,
height=4, bd=4, font='-weight bold')
go.grid(column=1, row=5)

adios = Button(master, text="EXIT", command=exit, bg="red3", width=21, height=4,
bd=4, font='-weight bold')
adios.grid(column=3, row=5)

resetb = Button(master, text="RESET", command=reset, bg="yellow3", width=21,
height=4, bd=4, font='-weight bold')
resetb.grid(column=2, row=5)

mainloop()
