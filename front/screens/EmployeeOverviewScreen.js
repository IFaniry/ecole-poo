import { Text, StyleSheet, ScrollView } from 'react-native';

function EmployeeOverviewScreen({ route }) {
  const employee = route.params.employee;

  return (
    <ScrollView style={styles.rootContainer}>
      <Text
        style={styles.title}
        numberOfLines={3}
      >
        {`${employee.firstName} ${employee.name} du département ${employee.department}`}
      </Text>
    </ScrollView>
  );
}

export default EmployeeOverviewScreen;

const styles = StyleSheet.create({
  rootContainer: {
    marginBottom: 32
  },
  title: {
    fontWeight: 'bold',
    fontSize: 24,
    margin: 8,
    textAlign: 'center',
    color: 'white',
  }
});
