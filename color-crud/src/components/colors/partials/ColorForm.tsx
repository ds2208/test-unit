import { useState } from "react";
import { Button, Form } from "react-bootstrap";
import { useNavigate } from "react-router-dom";
import { createColor } from "../../../services/colors-service";

function ColorForm(props: ColorFormProps) {

  const navigate = useNavigate();
  const [colorName, setColorName] = useState('');
  const [colorHexValue, setColorHexValue] = useState('');
  const [colorStatus, setColorStatus] = useState(false);

  const [colorErrorName, setColorErrorName] = useState('');
  const [colorErrorHexValue, setColorErrorHexValue] = useState('');
  const [colorErrorStatus, setColorErrorStatus] = useState('');

  const handleSubmit = (e: any) => {
    e.preventDefault();
    const response = createColor(colorName, colorHexValue, colorStatus);
    response.catch(errors => {
      let validationErrors = errors.response.data.errors;
      if(validationErrors) {
        setColorErrorName(validationErrors.name ? validationErrors.name[0] : "");
        setColorErrorHexValue(validationErrors.hex_value ? validationErrors.hex_value[0] : "");
        setColorErrorStatus(validationErrors.status ? validationErrors.status[0] : "");
      }
    }).then(result => {
      if(result) {
        navigate('/colors');
      }
  });
  }

  return (
    <Form>
      <Form.Group className="mb-3" controlId="formBasicName">
        <Form.Label>Color Name</Form.Label>
        <Form.Control type="text" placeholder="Enter Color Name" value={colorName} onChange={(e) => {setColorName(e.target.value)}} />
        <Form.Text className="text-danger  error-container">{colorErrorName}</Form.Text>
      </Form.Group>
      <Form.Group className="mb-3" controlId="formBasicHexValue">
        <Form.Label>Hex Value</Form.Label>
        <Form.Control type="number" placeholder="Hex value" value={colorHexValue} onChange={(e) => {setColorHexValue(e.target.value)}}/>
        <Form.Text className="text-danger error-container">{colorErrorHexValue}</Form.Text>
      </Form.Group>
      <Form.Group className="mb-3" controlId="formBasicStatus">
        <Form.Check type="checkbox" label="Color status" checked={colorStatus} onChange={(e) => {setColorStatus(e.target.checked)}}/>
        <Form.Text className="text-danger error-container">{colorErrorStatus}</Form.Text>
      </Form.Group>
      <Button variant="outline-light" type="submit" onClick={(e) => handleSubmit(e)}>Submit</Button>
    </Form>
  );
}

type ColorFormProps = {};

export default ColorForm;