import { useState, useEffect, useContext } from 'react';
import axios from 'axios';
import { FlatList } from 'react-native';

import { AuthContext } from '../store/auth-context';
import EmployeeGridTile from '../components/EmployeeGridTile';
import LoadingOverlay from '../components/ui/LoadingOverlay';

function EmployeesScreen({ navigation }) {
  const authCtx = useContext(AuthContext);

  const [loading, setLoading] = useState(false);
  const [employees, setEmployees] = useState([]);

  useEffect(() => {
    const fetchEmployees = async function () {
      const url = 'http://localhost:8000/api/employees';

      try {
        const response = await axios.get(url, {
          headers: { Authorization: `Bearer ${authCtx.token}` }
        });
      
        setEmployees(response.data);
        setLoading(false);
      } catch (err) {
        console.error(err);

        setLoading(false);
      }
    };

    setLoading(true);
    fetchEmployees();
  }, []);

  function renderEmployeeItem(itemData) {
    function pressHandler() {
      navigation.navigate('EmployeeOverview', {
        employee: itemData.item,
      });
    }

    return (
      <EmployeeGridTile
        name={itemData.item.name}
        department={itemData.item.department}
        onPress={pressHandler}
      />
    );
  }

  if (loading) {
    return <LoadingOverlay message="Chargement..." />;
  }

  return (
    <FlatList
      data={employees}
      keyExtractor={(item) => item.id}
      renderItem={renderEmployeeItem}
    />
  );
}

export default EmployeesScreen;
