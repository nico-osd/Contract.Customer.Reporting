<span class="required_notification">* Ben&ouml;tigte Felder</span>
<ul>
    <li>
        <label for="ort">Ort:</label>
        <input id="ort" name="ort" value="" type="text" placeholder="Ort" maxlength="255"
               required/>
    </li>
    <li>
        <label for="postleitzahl">PLZ:</label>
        <input style="width: auto" id="postleitzahl" name="postleitzahl" value="" type="number"
               placeholder="#"
               min="1010" max="9990" required/>
    </li>
    <li>
        <label for="strasse">Stra&szlig;e:</label>
        <input id="strasse" name="strasse" value="" type="text" placeholder="Stra&szlig;e"
               maxlength="255" required/>
    </li>
    <li>
        <label for="hausnummer">Hausnummer</label>
        <input style="width: auto" id="hausnummer" name="hausnummer" value="" type="number"
               placeholder="#"
               size="4"
               max="1000" min="1" required/>
    </li>
    <li>
        <label for="stiege">Stiege</label>
        <input style="width: auto" id="stiege" name="stiege" value="" type="number" placeholder="#"
               size="4" max="1000" min="1"/>
    </li>
    <li>
        <label for="tuernummer">T&uuml;rnummer</label>
        <input style="width: auto" id="tuernummer" name="tuernummer" value="" type="number"
               placeholder="#"
               size="4" max="1000" min="1"/>
    </li>
    <li style="padding:12px;border-bottom:1px solid #eee;position:relative;">
        <label for="land">Land</label>
        <input id="land" name="land" value="&Ouml;sterreich" type="text" placeholder="Land"
               maxlength="255"
               required/>
    </li>

</ul>