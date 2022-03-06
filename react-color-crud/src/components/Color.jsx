import React, {useState} from "react";
import Action from "./Actions";

function Color({color, colors, setColors}) {
  const [colorName, setColorName] = useState(color.name);
  const [colorHexValue, setColorHexValue] = useState(color.hex_value);
  const [colorStatus, setColorStatus] = useState(color.status);

  return (
    <tr>
        <td>{color.id ? <p>{color.id}</p> : "#"}</td>
        <td>{colorName ? <p>{colorName}</p> : ""}</td>
        <td>{colorHexValue ? <p>{colorHexValue}</p> : "N/A"}</td>
        <td>{color.status ? <p>Active</p> : <p>Disabled</p>}</td>
        <td>{color.created_at ? <p>{color.created_at}</p> : "N/A"}</td>
        <td>{<Action actionColor = {color} colorStatus = {colorStatus} setColorStatus = {setColorStatus} colors = {colors} setColors = {setColors}/>}</td>
    </tr>
  );
}

export default Color;