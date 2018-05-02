import numpy as np
import pandas as pd
import datetime
import urllib

from bokeh.plotting import *
from bokeh.models import HoverTool
from collections import OrderedDict

query = (https://data.colorado.gov/resource/a97x-8zfv.json)
raw_data = pd.read_json(query)